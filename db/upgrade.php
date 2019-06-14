<?php
require(__DIR__ . '/../../config.php');

function xmldb_local_diario_mural_upgrade($oldversion)
{
    global $DB;
    $dbman = $DB->get_manager();

    if ($oldversion < 20190612301) {

        //Define table tipo_aviso to be created.
        $table = new xmldb_table('tipo_aviso');

        // Adding fields to table tipo_aviso.
        $table->add_field('id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->add_field('nombre', XMLDB_TYPE_CHAR, '250', null, null, null, null);

        // Adding keys to table tipo_aviso.
        $table->add_key('primary', XMLDB_KEY_PRIMARY, array('id'));

        // Conditionally launch create table for tipo_aviso.
        if (!$dbman->table_exists($table)) {
            $dbman->create_table($table);
        }

        // Define table aviso to be created.
        $table = new xmldb_table('aviso');

        // Adding fields to table aviso.
        $table->add_field('id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->add_field('title', XMLDB_TYPE_CHAR, '200', null, null, null, null);
        $table->add_field('description', XMLDB_TYPE_CHAR, '300', null, null, null, null);
        $table->add_field('fecha_publicacion', XMLDB_TYPE_TEXT, null, null, null, null, null);
        $table->add_field('id_tipo_aviso', XMLDB_TYPE_INTEGER, '10', null, null, null, null);
        $table->add_field('id_user', XMLDB_TYPE_INTEGER, '10', null, null, null, null);

        // Adding keys to table aviso.
        $table->add_key('primary', XMLDB_KEY_PRIMARY, array('id'));
        $table->add_key('fk_tipo_aviso', XMLDB_KEY_FOREIGN, array('id_tipo_aviso'), 'tipo_aviso', array('id'));
        $table->add_key('fk_user', XMLDB_KEY_FOREIGN, array('id_user'), 'mdl_user', array('id'));

        // Conditionally launch create table for aviso.
        if (!$dbman->table_exists($table)) {
            $dbman->create_table($table);
        }


        // Conditionally launch create table for aviso.
        if ($dbman->table_exists($table)) {
            $tipo_aviso1 = new stdClass();
            $tipo_aviso1->nombre = 'Enseñanza';

            $tipo_aviso2 = new stdClass();
            $tipo_aviso2->nombre = 'Venta';

            $tipo_aviso3 = new stdClass();
            $tipo_aviso3->nombre = 'Objetos perdidos';

            // Insert one record at a time.
            $insert1 = $DB->insert_record('tipo_aviso', $tipo_aviso1);
            $insert2 = $DB->insert_record('tipo_aviso', $tipo_aviso2);
            $insert3 = $DB->insert_record('tipo_aviso', $tipo_aviso3);
        }


        // Database savepoint reached.
        upgrade_block_savepoint(true, 20190612302, 'database');

    }

    return true;
}
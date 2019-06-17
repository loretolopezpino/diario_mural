<?php

// Este archivo se ejecuta luego de la creación de la base de datos

function xmldb_local_diario_mural_install(){

    global $DB;

        $transaction = $DB->start_delegated_transaction();

        try {

            $tipo_aviso1 = new stdClass();
            $tipo_aviso1->nombre = 'Enseñanza';

            $tipo_aviso2 = new stdClass();
            $tipo_aviso2->nombre = 'Ventas';


            $tipo_aviso3 = new stdClass();
            $tipo_aviso3->nombre = 'Objetos perdidos';

            // Insert one record at a time.
            $insert1 = $DB->insert_record('tipo_aviso', $tipo_aviso1);
            $insert2 = $DB->insert_record('tipo_aviso', $tipo_aviso2);
            $insert3 = $DB->insert_record('tipo_aviso', $tipo_aviso3);

            // Assuming the both inserts work, we get to the following line.
            $transaction->allow_commit();

        }
        catch (Exception $e) {
            $transaction->rollback($e);
        }
}

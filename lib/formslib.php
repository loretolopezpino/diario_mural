<?php
    function insertRecord($titulo, $descripcion, $id_tipo_aviso){
        global $DB, $USER;
        $record = new stdClass();
        $record->titulo = $titulo;
        $record->descripcion = $descripcion;
        $record->fecha_creacion = date('Y-m-d H:i');
        $record->id_tipo_aviso = $id_tipo_aviso;
        $record->id_user = $USER->id;
        // Insert register
        $DB->insert_record('aviso', $record);
    }

    function updateRecord($id_aviso, $titulo, $descripcion, $id_tipo_aviso){
        global $DB;

        $record = new stdClass();
        $record->id = $id_aviso;
        $record->titulo = $titulo;
        $record->descripcion = $descripcion;;
        $record->id_tipo_aviso = $id_tipo_aviso;
        $DB->update_record('aviso', $record);
    }

    function deleteRegister($id_aviso){
        global $DB, $action;
        //Borrando el aviso
        if ($DB->delete_records("aviso", array("id" => $id_aviso))){
            $action = 'view';
        }
        else {
            return false;
        }
        return true;
    }

    function getAvisosUsuario($id_usuario){

        global $DB;
        $sql = 'SELECT a.id, a.titulo, ta.nombre as Categoria
                FROM {aviso} a
                INNER JOIN {tipo_aviso} ta
                ON ta.id = a.id_tipo_aviso
                INNER JOIN {user} u
                ON u.id = a.id_user
                AND u.id ='. $id_usuario.
                ' ORDER BY a.fecha_creacion DESC';

        var_dump($sql);
        exit;

        $avisos = $DB->get_records_sql($sql, null);


        return $avisos;
    }

    function getAllAvisos(){
        global $DB;
        $sql = 'SELECT a.id, a.titulo, ta.nombre as categoria, a.fecha_creacion as fecha
                    FROM {aviso} a
                    INNER JOIN {tipo_aviso} ta
                    ON ta.id = a.id_tipo_aviso
                    ORDER BY a.fecha_creacion DESC';

        $avisos = $DB->get_records_sql($sql, null);

        return $avisos;
    }

    function findAviso($id_aviso){
        global $DB;
        $aviso = $DB->get_record('aviso', ['id' => $id_aviso]); //select*

        return $aviso;
    }


    function retornaVistaMisAvisos($OUTPUT){
        $avisos = getAllAvisos();
        $avisos_table = new html_table();

        if(sizeof($avisos) > 0){

            $avisos_table->head = [
                'Título',
                'Categoría'
            ];

            foreach($avisos as $aviso){

                /**
                 *Botón eliminar
                 * */
                $delete_url = new moodle_url('/local/diario_mural/usuario_avisos.php', [
                    'action' => 'delete',
                    'id_aviso' =>  $aviso->id

                ]);
                $delete_ic = new pix_icon('t/delete', 'Eliminar');
                $delete_action = $OUTPUT->action_icon(
                    $delete_url,
                    $delete_ic,
                    new confirm_action('¿Está seguro de eliminar este aviso?')
                );

                /**
                 *Botón editar
                 * */
                $editar_url = new moodle_url('/local/diario_mural/edit.php', [
                    'action' => 'edit',
                    'id_aviso' =>  $aviso->id

                ]);
                $editar_ic = new pix_icon('i/edit', 'Editar');
                $editar_action = $OUTPUT->action_icon(
                    $editar_url,
                    $editar_ic
                );

                /**
                 *Botón ver
                 * */
                $ver_url = new moodle_url('/local/diario_mural/view.php', [
                    'action' => 'edit',
                    'id_aviso' =>  $aviso->id

                ]);
                $ver_ic = new pix_icon('t/hide', 'Ver');
                $ver_action = $OUTPUT->action_icon(
                    $ver_url,
                    $ver_ic
                );

                $avisos_table->data[] = array(
                    $aviso->titulo,
                    $aviso->categoria,
                    $ver_action.' '.$editar_action.' '.$delete_action
                );
            }
        }

        $url_button = new moodle_url("/local/diario_mural/create.php", array("action" => "add"));

        $top_row = [];
        $top_row[] = new tabobject(
            'avisos',
            new moodle_url('/local/diario_mural/index.php'),
            ' Avisos'
        );
        $top_row[] = new tabobject(
            'mis_avisos',
            new moodle_url('/local/diario_mural/usuario_avisos.php'),
            'Mis avisos'
        );


        // Displays all the records, tabs, and options
        echo $OUTPUT->tabtree($top_row, 'mis_avisos');
        if (sizeof(getAllAvisos()) == 0){
            echo html_writer::nonempty_tag('h3', 'No has creado avisos', array('align' => 'left'));
        }
        else{
            echo html_writer::table($avisos_table);
        }

        echo html_writer::nonempty_tag("div", $OUTPUT->single_button($url_button, "Publicar Aviso"), array("align" => "left"));

}


function retornarVistaAviso($id_aviso){

    $aviso = findAviso($id_aviso);
    $table = new html_table();
    $table->head = array('titulo ','descripcion');

    // Add the [] to data and just a single array.
    $table->data[] = array($aviso->titulo, $aviso->descripcion);

    // Outside the loop.
    echo html_writer::table($table);
}
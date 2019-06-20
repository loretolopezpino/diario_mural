<?php
    function insertRegister($titulo, $descripcion, $id_tipo_aviso, $id_user){
        global $DB;
        $register = new stdClass();
        $register->titulo = $titulo;
        $register->descripcion = $descripcion;
        $register->fecha_creacion = date('Y-m-d H:i');
        $register->id_tipo_aviso = $id_tipo_aviso;
        $register->id_user = $id_user;
        // Insert register
        $DB->insert_record('aviso', $register);
    }

    function getAvisosUsuario($id_usuario){

        global $DB;
        $sql = 'SELECT a.id, a.titulo, ta.nombre as Categoria
                FROM {aviso} a
                INNER JOIN {tipo_aviso} ta
                ON ta.id = a.id_tipo_aviso
                INNER JOIN {user} u
                ON u.id = a.id_user
                AND u.id ='. $id_usuario;

        $avisos = $DB->get_records_sql($sql, null);


        return $avisos;
    }

    function getAllAvisos(){
        global $DB;
        $sql = 'SELECT a.id, a.titulo, ta.nombre as Categoria
                    FROM {aviso} a
                    INNER JOIN {tipo_aviso} ta
                    ON ta.id = a.id_tipo_aviso';

        $avisos = $DB->get_records_sql($sql, null);

        return $avisos;
    }

    function findAviso($id_aviso){
        global $DB;
        $sql = 'SELECT a.titulo, ta.nombre as categoria
                    FROM {aviso} a
                    WHERE id ='.$id_aviso;

        //$aviso = $DB->get_records_sql($sql, null);
        $aviso = $DB->get_record('aviso', ['id' => $id_aviso]); //select*

        return $aviso;
    }


    function retornaVistaMisavisos($OUTPUT){
            $avisos = getAllAvisos();
            $avisos_table = new html_table();

            if(sizeof($avisos) > 0){

                $avisos_table->head = [
                    'Título',
                    'Categoría'
                ];

                foreach($avisos as $aviso){
                    $avisos_table->data[] = array(
                        $aviso->titulo,
                        $aviso->categoria
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
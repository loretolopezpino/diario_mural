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
    $sql = 'SELECT a.titulo, ta.nombre as Categoria
                FROM {aviso} a
                INNER JOIN {tipo_aviso} ta
                ON ta.id = a.id_tipo_aviso';

    $avisos = $DB->get_records_sql($sql, null);
    $DB->close();

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
<?php


    //Para incresar a esta página la URL es http://localhost/moodle_2019_06_13/local/diario_mural/create.php

    //include simplehtml_form.php
    require_once('forms/create_form.php');

    global $DB, $PAGE, $OUTPUT, $USER;

    $context = context_system::instance();
    $url = new moodle_url("local/diario_mural/create.php");
    $PAGE->set_url($url);
    $PAGE->set_context($context);
    $PAGE->set_pagelayout("standard");


    // Possible actions -> view, add, edit or delete. Standard is view mode
    $action = optional_param("action", "add", PARAM_TEXT);

    require_login();
    if (isguestuser()){
        die();
    }

    if($action == 'add'){
        //Instantiate create_form
        $addForm = new create_form();

        //Form processing and displaying is done here
        if ($addForm->is_cancelled()) {
            //Handle form cancel operation, if cancel button is present on form

        }
        else if ($data = $addForm->get_data()) {
            //In this case you process validated data. $mform->get_data() returns data posted in form.
            $register = new stdClass();
            $register->titulo = $data->titulo;
            $register->descripcion = $data->descripcion;
            $register->fecha_creacion =  date('Y-m-d H:i');
            $register->id_tipo_aviso = $data->id_tipo_aviso;
            $register->id_user = $USER->id;

            // Insert register
            $lastinsert= $DB->insert_record('aviso', $register);


            $action = "add";
        }
        else{
            $addForm->display();


        }



    }










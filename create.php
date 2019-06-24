<?php
    //Para incresar a esta página la URL es http://localhost/moodle_2019_06_13/local/diario_mural/create.php

    //include simplehtml_form.php
    require_once('forms/create_form.php');
    require_once ('lib/formslib.php');

    global $DB, $PAGE, $OUTPUT, $USER;

    //$create = $this->view;
    //$url_create= $create->get_baseurl();
    $addForm = new create_form();
    $context = context_system::instance();
    $url = new moodle_url('/local/diario_mural/create.php');
    $PAGE->set_url($url);
    $PAGE->set_context($context);
    $PAGE->set_pagelayout("standard");

    // Possible actions -> view, add, edit or delete. Standard is view mode
    $action = optional_param("action", "add", PARAM_TEXT);
    $id_aviso = optional_param("id_aviso", null, PARAM_INT);

    require_login();
    if (isguestuser()){
        die();
    }

    $PAGE->set_title(get_string('title', 'local_diario_mural'));
    $PAGE->set_heading(get_string('heading', 'local_diario_mural'));

    echo $OUTPUT->header();

    if($action == 'add'){
        //Form processing and displaying is done here
        if ($addForm->is_cancelled()) {
            //Handle form cancel operation, if cancel button is present on form

            $action = 'view';
        }
        else if ($data = $addForm->get_data()) {
            //In this case you process validated data. $mform->get_data() returns data posted in form.
            insertRecord($data->titulo, $data->descripcion, $data->id_tipo_aviso, $USER->id, $DB);
            $action = 'view';
        }
        else{
            $addForm->display();
        }
    }


    //Lista de todos los registros de aviso
    if($action == 'view'){
        retornaVistaMisAvisos($OUTPUT);
    }


echo $OUTPUT->footer();






















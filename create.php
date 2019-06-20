<?php
    //Para incresar a esta página la URL es http://localhost/moodle_2019_06_13/local/diario_mural/create.php

    //include simplehtml_form.php
    require_once('forms/create_form.php');
    require_once ('lib/formslib.php');

    global $DB, $PAGE, $OUTPUT, $USER, $url_create, $addForm;
    $url_create= '/local/diario_mural/create.php';

    //$create = $this->view;
    //$url_create= $create->get_baseurl();
    $addForm = new create_form();
    //include('header.php');
    //////////////////////////////////////////////////////////////////////////////
    $context = context_system::instance();
    $url = new moodle_url($url_create);
    $PAGE->set_url($url);
    $PAGE->set_context($context);
    $PAGE->set_pagelayout("standard");

    // Possible actions -> view, add, edit or delete. Standard is view mode
    $action = optional_param("action", "add", PARAM_TEXT);

    require_login();
    if (isguestuser()){
        die();
    }

    $PAGE->set_title(get_string('title', 'local_diario_mural'));
    $PAGE->set_heading(get_string('heading', 'local_diario_mural'));

    echo $OUTPUT->header();
    /////////////////////////////////////////////////////////////////////////////////////

    if($action == 'add'){
        //Form processing and displaying is done here
        if ($addForm->is_cancelled()) {
            //Handle form cancel operation, if cancel button is present on form

            $action = 'view';
        }
        else if ($data = $addForm->get_data()) {
            //In this case you process validated data. $mform->get_data() returns data posted in form.
            insertRegister($data->titulo, $data->descripcion, $data->id_tipo_aviso, $USER->id, $DB);
            $action = 'view';
        }
        else{
            $addForm->display();
        }
    }

    //Lista de todos los registros de aviso
    if($action == 'view'){

        retornaVistaMisavisos($OUTPUT);

        /*$avisos = getAllAvisos();
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
        );*/
    }

    // Displays all the records, tabs, and options
    /*if ($action == 'view'){
        echo $OUTPUT->tabtree($top_row, 'mis_avisos');
        if (sizeof(getAllAvisos()) == 0){
            echo html_writer::nonempty_tag('h3', 'No has creado avisos', array('align' => 'left'));
        }else{
            echo html_writer::table($avisos_table);
        }

        echo html_writer::nonempty_tag("div", $OUTPUT->single_button($url_button, "Publicar Aviso"), array("align" => "left"));
    }*/

echo $OUTPUT->footer();






















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

    if($action == 'view'){


       //var_dump('Primer view');

        $avisos = getAvisosUsuario($USER->id);
        $tableMisAvisos = new html_table();

        if(sizeof($avisos) > 0){
            $tableMisAvisos->head = array(
               'Avisos',
               'Mis Avisos',
            );

           // var_dump($tableMisAvisos);
            foreach ($avisos as $aviso){
                // Define delete icon and url

                $deleteUrl = new moodle_url($url_create, array(
                    "action" => "delete",
                    "id" => $aviso->id,
                ));
            }
       }

        $createButton = new moodle_url($url_create, ['action' => 'add']);

        $topRow = array();
        $topRow[] = new tabobject(
            "Buscar Apuntes",
            new moodle_url("/local/diario_mural/view.php"),
            "Avisos"
        );
        $topRow[] = new tabobject(
            "Mis Apuntes",
            new moodle_url("/local/diario_mural/view.php"),
            "Mis Avisos"
        );
    }

    // Displays all the records, tabs, and options
    if ($action == 'view'){

        //var_dump('entró al custion');

        echo $OUTPUT->tabtree($topRow, "Mis Avisos");

        //var_dump('Pasó el echo');

        if (sizeof($avisos) == 0){
            echo html_writer::nonempty_tag("h4", "No has publicado avisos", array("align" => "center"));


        }
        else{
            echo html_writer::table($tableMisAvisos);

            var_dump('El usuario tiene avisos');
        }

        echo html_writer::nonempty_tag("div", $OUTPUT->single_button($createButton, "Nuevo Aviso"), array("align" => "center"));

    }

echo $OUTPUT->footer();






















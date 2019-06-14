<?php


    //Para incresar a esta página la URL es http://localhost/moodle_2019_06_13/local/diario_mural/create.php

    //include simplehtml_form.php
    require_once('forms/create_form.php');

    global $DB, $PAGE, $OUTPUT, $USER;

    $context = context_system::instance();
    $url = new moodle_url("local/diario_mural/create.php");
    $PAGE->set_url($url);
    $PAGE->set_context($context);
    $PAGE->set_pagelayout("standar");







    //Instantiate simplehtml_form
    $mform = new create_form();

    //Form processing and displaying is done here
    if ($mform->is_cancelled()) {
        //Handle form cancel operation, if cancel button is present on form

        var_dump('1');
        exit;
    }
    else if ($fromform = $mform->get_data()) {
        //In this case you process validated data. $mform->get_data() returns data posted in form.
        var_dump('2');
        exit;
    }
    else {
        // this branch is executed if the form is submitted but the data doesn't validate and the form should be redisplayed
        // or on the first display of the form.

        //var_dump('3');
        //exit;

        //Set default data (if any)
        $mform->set_data($toform);
        //displays the form
        $mform->display();
    }





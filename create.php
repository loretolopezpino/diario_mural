<?php

    //include create_form.php
    require_once('forms/create_form.php');

    //Instantiate simplehtml_form
    $mform = new create_form();

    //Form processing and displaying is done here
    if ($mform->is_cancelled()) {
        //Handle form cancel operation, if cancel button is present on form
    }
    else if ($fromform = $mform->get_data()) {
        //In this case you process validated data. $mform->get_data() returns data posted in form.
    }
    else {
        // this branch is executed if the form is submitted but the data doesn't validate and the form should be redisplayed
        // or on the first display of the form.

        //Set default data (if any)
        $mform->set_data($toform);
        //displays the form
        $mform->display();
    }

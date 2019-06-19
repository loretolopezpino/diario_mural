<?php

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

$PAGE->set_title(get_string('title', 'local_diario_mural'));
$PAGE->set_heading(get_string('heading', 'local_diario_mural'));

echo $OUTPUT->header();
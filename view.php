<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.
/**
 * @package    local
 * @subpackage diario_mural
 * @copyright  2019 UAI
 * @author  2019 Loreto López Pino <loreto.lopezpino@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once (dirname(dirname(dirname(__FILE__)))."/config.php");
require_once ('forms/create_form.php');

global $DB, $PAGE, $OUTPUT, $USER;
$context = context_system::instance();
$url = new moodle_url("/local/diario_mural/view.php");
$PAGE->set_url($url);
$PAGE->set_context($context);
$PAGE->set_pagelayout("standard");

// Possible actions -> view, add. Standard is view mode
$action = optional_param("action", "view", PARAM_TEXT);
$id_aviso = optional_param("id_aviso", null, PARAM_INT);

require_login();
if (isguestuser()){
    die();
}
$PAGE->set_title(get_string("title", 'DIARIO MURAL'));
$PAGE->set_heading(get_string("heading", 'DIARIO MURAL'));

echo $OUTPUT->header();

if($action == 'view'){

    var_dump('entro al view');
    exit;
    $avisos = getAllAvisos();
    $avisosTable = new html_table();

    if(sizeof($avisos) > 0){

        $avisosTable->head = [
            'Título',
            'Categoría'
        ];

        foreach($avisos as $aviso){
            $avisosTable->data[] = array($aviso->titulo,
                $aviso->categoria);
        }
    }

    $avisoUrl = new moodle_url("/local/diario_mural/create.php", ['action' => 'add']);
    $topRow = [];
    $toprow[] = new tabobject(
        "Avisos",
        new moodle_url("/local/diario_mural/view.php"),
        "Buscar Apuntes"
    );
    $toprow[] = new tabobject(
        "Mis avisos",
        new moodle_url("/local/apuntes/create.php"),
        "Mis avisos"
    );
}



// Displays all the records, tabs, and options
if ($action == "view"){
    echo $OUTPUT->tabtree($toprow, "Buscar Apuntes");
    if (sizeof(getAllAvisos()) == 0){
        echo html_writer::nonempty_tag("h4", "No has creado avisos", array("align" => "center"));
    }else{
        echo html_writer::table($avisosTable);
        exit;
    }

}
echo $OUTPUT->footer();
















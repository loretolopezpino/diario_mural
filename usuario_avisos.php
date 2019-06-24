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

require_once ('forms/view_form.php');
require_once ('lib/formslib.php');
require(__DIR__.'/../../config.php');

global $DB, $PAGE, $OUTPUT, $USER;

$url_view= '/local/diario_mural/view.php';

$context = context_system::instance();
$url = new moodle_url($url_view);
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
$PAGE->set_title(get_string("title", 'local_diario_mural'));
$PAGE->set_heading(get_string("heading", 'local_diario_mural'));

echo $OUTPUT->header();

if($action == 'edit'){

}

// Delete the selected record
if ($action == "delete"){

    if(!deleteRegister($id_aviso)){
        print_error("Aviso no existe.");
    }
    $action = 'view';
}

//Lista de todos los registros de aviso
if($action == 'view'){
    retornaVistaMisAvisos($OUTPUT);
}
   /* //Se obtienen los avisos del usuario
    $avisos = getAvisosUsuario($USER->id);
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
        new moodle_url('/local/diario_mural/create.php'),
        'Mis avisos'
    );


}



// Displays all the records, tabs, and options
if ($action == 'view'){
    echo $OUTPUT->tabtree($top_row, 'mis_avisos');
    if (sizeof(getAllAvisos()) == 0){
        echo html_writer::nonempty_tag('h3', 'No has creado avisos', array('align' => 'center'));
    }else{
        echo html_writer::table($avisos_table);
    }

    echo html_writer::nonempty_tag("div", $OUTPUT->single_button($url_button, "Publicar Aviso"), array("align" => "left"));

}*/
echo $OUTPUT->footer();
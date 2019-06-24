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

    //Lista de todos los registros de aviso
    if($action == 'view'){

        $avisos = getAllAvisos();
        $avisos_table = new html_table();

        if(sizeof($avisos) > 0){

            $avisos_table->head = [
                'Título',
                'Categoría',
                'Fecha Publicación'
            ];

            foreach($avisos as $aviso){

                /**
                 *Botón ver
                 * */
                $ver_url = new moodle_url('/local/diario_mural/view.php', [
                    'action' => 'view',
                    'id_aviso' =>  $aviso->id,

                ]);
                $ver_ic = new pix_icon('t/hide', 'Ver');
                $ver_action = $OUTPUT->action_icon(
                    $ver_url,
                    $ver_ic
                );

                $avisos_table->data[] = array(
                    $aviso->titulo,
                    $aviso->categoria,
                    date('d-m-Y',strtotime($aviso->fecha)),
                    $ver_action
                );
            }
        }

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
        );


    }



    // Displays all the records, tabs, and options
    if ($action == 'view'){
        echo $OUTPUT->tabtree($top_row, 'avisos');
        if (sizeof(getAllAvisos()) == 0){
            echo html_writer::nonempty_tag('h3', 'No has creado avisos', array('align' => 'center'));
        }else{
            echo html_writer::table($avisos_table);
        }

    }
    echo $OUTPUT->footer();
















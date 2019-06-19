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

// You can access the database via the $DB method calls here.
require(__DIR__.'/../../../config.php');

//Necesario para desplegar el formulario
require_once ($CFG->libdir . '/formslib.php');

class create_form extends moodleform {
    //Add elements to form
    public function definition() {
        global $CFG;

        $mform = $this->_form; // Don't forget the underscore!


        $tipos_aviso = $this->getTiposAviso();
        $dropDownAviso = [];

        foreach ($tipos_aviso as $tipo_aviso){
            $dropDownAviso[$tipo_aviso->id] = $tipo_aviso->nombre;
        }

        //Tipo Aviso Drop Down
        $mform->addElement("select", "id_tipo_aviso", get_string('titulo', 'local_diario_mural'), $dropDownAviso);
        // Title input
        $mform->addElement ("text", "titulo", get_string('titulo', 'local_diario_mural'));
        $mform->setType ("titulo", PARAM_TEXT);

        //Description input
        $mform->addElement ('textarea','descripcion', get_string('titulo', 'local_diario_mural'), 'wrap="virtual" rows="5" cols="50"');
        $mform->setType ('descripcion', PARAM_RAW);


        // Set action to "add"
        $mform->addElement ("hidden", "action", "add");
        $mform->setType ("action", PARAM_TEXT);
        $this->add_action_buttons(true);

    }
    //Custom validation should be added here
    function validation($data, $files) {

        global $DB;
        $errors = array();

        $id_tipo_aviso = $data["id_tipo_aviso"];
        $titulo = $data["titulo"];
        $descripcion = $data["descripcion"];

        if(!isset($id_tipo_aviso) && empty($id_tipo_aviso)){

            $errors[$id_tipo_aviso] = "Campo requerido.";
        }

        //!isset($titulo) || empty($titulo) ||
        if( strlen($titulo)== 0){
            $errors[$titulo] = "Campo requerido.";
        }

        if( strlen($descripcion)== 0){
            $errors[$descripcion] = "Campo requerido.";
        }

        return $errors;
    }

    function getTiposAviso(){
        global $DB;

        // Query para onbtener los registro de la tabla Tipo de Aviso
        $sql = 'SELECT id, nombre
				FROM {tipo_aviso}';

        // Retornando registros de la tabla Tipo Aviso
        return  $DB->get_records_sql($sql,null);
    }



}


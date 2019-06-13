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


$string = 'hola';


//echo $string;


require(__DIR__ . '/../../../config.php');
//require_once $CFG->libdir.'/filelib.php';

//necesario para desplegar el formulario
require_once ($CFG->libdir . '/formslib.php');

class create_form extends moodleform {
    //Add elements to form
    public function definition() {
        global $CFG;

        $mform = $this->_form; // Don't forget the underscore!

        $mform->addElement('text', 'email', get_string('email')); // Add elements to your form
        $mform->setType('email', PARAM_NOTAGS);                   //Set type of element
        $mform->setDefault('email', 'Ingrese su email');        //Default value

        $mform->addElement('text', 'email', get_string('email')); // Add elements to your form
        $mform->setType('email', PARAM_NOTAGS);                   //Set type of element
        $mform->setDefault('email', 'Please enter email');        //Default value


        //Adding button
        //$mform->addElement('button', get_string('button1', 'local_diario_mural'));

        //add radio button
        $radioarray=array();
        $radioarray[] = $mform->createElement('radio', 'yesno', '', get_string('yes'), 1, $attributes);
        $radioarray[] = $mform->createElement('radio', 'yesno', '', get_string('no'), 0, $attributes);
        $mform->addGroup($radioarray, 'radioar', '', array(' '), false);

        //$mform->closeHeaderBefore('button1');


    }
    //Custom validation should be added here
    function validation($data, $files) {
        return array();
    }
}
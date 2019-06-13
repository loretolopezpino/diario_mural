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
 * @package    block
 * @subpackage database
 * @copyright  2019 UAI
 * @author  2019 Loreto López Pino <loreto.lopezpino@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


defined('MOODLE_INTERNAL') || die();
require_once (dirname(dirname(dirname(dirname(__FILE__))))."/config.php");
require_once ($CFG->libdir."/formslib.php");

class create_form extends moodleform{

    //Add elements to form
    public function definition()
    {
        global $CFG, $DB;

        $mform = $this->_form;

        // Query for retrieving tipos records
        $sql = 'SELECT id, nombre
				FROM {tipo_aviso}';

        $tipos = [];
        foreach ($tipos as $tipo){
        }

        $mform->addElement('text', 'email', get_string('email')); // Add elements to your form
        $mform->setType('email', PARAM_NOTAGS);                   //Set type of element
        $mform->setDefault('email', 'Please enter email');        //Default value


    }

    //Custom validation should be added here
    function validation($data, $files)
    {
        global $DB;
        $errors = [];

        return array();
    }
}

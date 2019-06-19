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

class edit_form extends moodleform {
    //Add elements to form
    public function definition()
    {
        global $CFG;
        $editForm = $this->_form;
        $instance = $this->_customdata;
        $id_aviso = $instance['id_aviso'];


        $aviso = findAviso($id_aviso);

    }
}
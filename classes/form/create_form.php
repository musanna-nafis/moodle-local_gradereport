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
 * Edit form class.
 *
 * @package    local_gradereport
 * @copyright  2025 Hasan Al Musanna
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once("$CFG->libdir/formslib.php");

class create_form extends moodleform {

    protected $data;

    /**
     * Constructor.
     */
    public function __construct($actionurl, $data = null) {
        $this->data = $data;
        parent::__construct($actionurl);
    }
    //Add elements to form
    public function definition() {
        global $CFG;
        $mform = $this->_form; // Don't forget the underscore!

        $mform->addElement('hidden', 'id', get_string('id', 'local_gradereport'));
        $mform->setType('id', PARAM_INT);
        $mform->setDefault('id', $this->data->id ?? "");

        $mform->addElement('text', 'username', get_string('username', 'local_gradereport'));
        $mform->setType('username', PARAM_TEXT);
        $mform->setDefault('username', $this->data->username ?? "");

        $mform->addElement('text', 'written', get_string('written', 'local_gradereport'));
        $mform->setType('written', PARAM_INT);
        $mform->setDefault('written', $this->data->written ?? "");

        $mform->addElement('text', 'mcq', get_string('mcq', 'local_gradereport'));
        $mform->setType('mcq', PARAM_INT);
        $mform->setDefault('mcq', $this->data->mcq ?? "");

        $mform->addElement('text', 'total_marks', get_string('total_marks', 'local_gradereport'));
        $mform->setType('total_marks', PARAM_INT);
        $mform->setDefault('total_marks', $this->data->total_marks ?? "");

        $mform->addElement('text', 'grade', get_string('grade', 'local_gradereport'));
        $mform->setType('grade', PARAM_TEXT);
        $mform->setDefault('grade', $this->data->grade ?? "");

        $this->add_action_buttons(true,get_string('createbutton','local_gradereport'));
    }
}
<?php

require_once("$CFG->libdir/formslib.php");

class create_form extends moodleform {

    protected $data;

    public function __construct($actionurl, $data = null) {
        $this->data = $data;
        parent::__construct($actionurl);
    }
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
<?php
require_once(__DIR__.'/../../config.php');
require_once('./locallib.php');
require_once($CFG->dirroot.'/local/gradereport/classes/form/create_form.php');
try {
    require_login();
} catch (Exception $exception) {
    print_r($exception);
}
$PAGE->set_url(new moodle_url('/local/gradereport/create.php'));
$PAGE->set_context(\context_system::instance());
$PAGE->set_title(get_string('createtitle', 'local_gradereport'));

$mform = local_gradereport_create_form();
local_gradereport_create_grade($mform);

echo $OUTPUT->header();
echo $OUTPUT->heading(get_string('createheader', 'local_gradereport'));

$mform->display();

echo $OUTPUT->footer();
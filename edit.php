<?php
require_once(__DIR__.'/../../config.php');
require_once('./locallib.php');
require_once($CFG->dirroot.'/local/gradereport/classes/form/edit_form.php');
try {
    require_login();
} catch (Exception $exception) {
    print_r($exception);
}
$id = optional_param('id', 0, PARAM_INT);
$PAGE->set_url(new moodle_url('/local/gradereport/edit.php', array('id' => $id)));
$PAGE->set_context(\context_system::instance());
$PAGE->set_title(get_string('updatetitle', 'local_gradereport'));

$mform = local_gradereport_update_form($id);
local_gradereport_update_grade($mform, $id);

echo $OUTPUT->header();
echo $OUTPUT->heading(get_string('updateheader', 'local_gradereport'));

$mform->display();

echo $OUTPUT->footer();
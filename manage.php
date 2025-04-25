<?php


require_once(__DIR__.'/../../config.php');
if (isset($_GET['delete'])) {
    require_once(__DIR__ . '/locallib.php');
    $id = (int) $_GET['delete'];
    delete_record_by_id($id);
    redirect(new moodle_url('/local/gradereport/manage.php'), 'Record deleted successfully', 2);
}

require_once('./locallib.php');
try {
    require_login();
} catch (Exception $exception) {
    print_r($exception);
}

$PAGE->set_url(new moodle_url('/local/gradereport/manage.php'));
$PAGE->set_context(\context_system::instance());
$PAGE->set_title(get_string('managepagetitle', 'local_gradereport'));

echo $OUTPUT->header();
echo $OUTPUT->heading(get_string('pluginname', 'local_gradereport'));

$PAGE->requires->js_call_amd('local_gradereport/confirmdelete', 'init', array());
local_gradereport_show_gardereport();



echo $OUTPUT->footer();
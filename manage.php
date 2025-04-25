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
 * Plugin manage page.
 *
 * @package    local_gradereport
 * @copyright  2025 Hasan Al Musanna
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

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
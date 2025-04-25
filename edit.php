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
 * Edit or Create a record.
 *
 * @package    local_gradereport
 * @copyright  2025 Hasan Al Musanna
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

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
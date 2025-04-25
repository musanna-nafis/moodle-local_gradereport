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
 * Plugin's library functions.
 *
 * @package    local_gradereport
 * @copyright  2025 Hasan Al Musanna
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * This function prints all the score from the db table.
 *
 * @return void
 * @throws dml_exception
 */


//include the CSS file
function local_gradereport_before_http_headers() {
    global $PAGE;
    $PAGE->requires->css('/local/gradereport/styles.css');
}

function local_gradereport_show_gardereport() {
    global $DB, $OUTPUT;
    $grades = $DB->get_records('local_gradereport');
    // Create a new url in moodle for edit
    $editurl=new moodle_url('/local/gradereport/edit.php');
    //create a new url in moodle for create record
    $createurl=new moodle_url('/local/gradereport/create.php');
    // Data to be passed through object in the manage template.
    $details = (object) [
        'displayedtext' => array_values($grades),
        'edit_url' => $editurl,
        'create_url' => $createurl,
    ];
    echo $OUTPUT->render_from_template('local_gradereport/manage', $details);
}
function local_gradereport_update_form(int $id){
    global $DB;
    $actionurl = new moodle_url('/local/gradereport/edit.php');
    $score = $DB->get_record('local_gradereport', array('id' => $id));
    $mform = new edit_form($actionurl, $score);
    return $mform;
}

function local_gradereport_update_grade(edit_form $mform, int $id) {
    global $DB;
    if ($mform->is_cancelled()) {
        //Back to manage.php
        redirect(new moodle_url('/local/gradereport/manage.php'));
    } else if ($fromform = $mform->get_data()) {
        // Handing the form data.
        $recordstoupdate = new stdClass();
        $recordstoupdate->id = $fromform->id;
        $recordstoupdate->username = $fromform->username;
        $recordstoupdate->written = $fromform->written;
        $recordstoupdate->mcq = $fromform->mcq;
        //total marks
        $total=$fromform->mcq+$fromform->written;
        $recordstoupdate->total_marks = $total;
        if($total>=80 and $total<=100) $recordstoupdate->grade='A+';
        else if($total>=70 and $total<=79) $recordstoupdate->grade='B+';
        else if($total>=60 and $total<=69) $recordstoupdate->grade='C+';
        else if($total>=50 and $total<=59) $recordstoupdate->grade='D+';
        else $recordstoupdate->grade='F';
        // Update the record.
        $DB->update_record('local_gradereport', $recordstoupdate);
        redirect(new moodle_url('/local/gradereport/manage.php'), get_string('updatethanks', 'local_gradereport'));
       
    }
}

function local_gradereport_create_form()
{
    $actionurl = new moodle_url('/local/gradereport/create.php');
    $mform = new create_form($actionurl, NULL);
    return $mform;
}

function local_gradereport_create_grade(create_form $mform) {
    global $DB;
    if ($mform->is_cancelled()) {
        //Back to manage.php
        redirect(new moodle_url('/local/gradereport/manage.php'));
    } else if ($fromform = $mform->get_data()) {
        // Handing the form data.
        $recordstoinsert = new stdClass();
        $recordstoinsert->username = $fromform->username;
        $recordstoinsert->written = $fromform->written;
        $recordstoinsert->mcq = $fromform->mcq;
        //total marks
        $total=$fromform->mcq+$fromform->written;
        $recordstoinsert->total_marks = $total;
        if($total>=80 and $total<=100) $recordstoinsert->grade='A+';
        else if($total>=70 and $total<=79) $recordstoinsert->grade='B+';
        else if($total>=60 and $total<=69) $recordstoinsert->grade='C+';
        else if($total>=50 and $total<=59) $recordstoinsert->grade='D+';
        else $recordstoinsert->grade='F';
        // Update the record.
        $DB->insert_record('local_gradereport', $recordstoinsert);
        redirect(new moodle_url('/local/gradereport/manage.php'), get_string('createthanks', 'local_gradereport'));
       
    }
}



function local_gradereport_delete_record($id) {
    global $DB;
    try {
        $DB->delete_records('local_gradereport', array('id' => $id));
    } catch (Exception $exception) {
        throw new moodle_exception($exception);
    }
}
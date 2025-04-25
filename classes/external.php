<?php

require_once($CFG->libdir . "/externallib.php");
require_once($CFG->dirroot . "/local/gradereport/locallib.php");


class local_gradereport_external extends external_api {
    /**
     * Returns description of method parameters.
     * @return external_function_parameters
     */
    public static function delete_record_by_id_parameters(): external_function_parameters {
        return new external_function_parameters(
            array(
                'recordid' => new external_value(PARAM_INT, 'record id'),
            )
        );
    }

    /**
     * Delete score by id function.
     *
     * @param int $scoreid
     * @return array
     * @throws moodle_exception
     */
    public static function delete_record_by_id(int $recordid): array {
        global $DB;

        $warnings = array();

        local_gradereport_delete_record($recordid);

        return array(
            'recordid' => $recordid,
            'warnings' => $warnings
        );

    }

    /**
     * Returns description of method result value.
     * @return external_description
     */
    public static function delete_record_by_id_returns() {
        return new external_single_structure(
            array(
                'recordid' => new external_value(PARAM_INT, 'record id'),
                'warnings' => new external_warnings()
            )
        );
    }
}
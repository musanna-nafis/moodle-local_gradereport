<?php

require_once($CFG->libdir . "/externallib.php");
require_once($CFG->dirroot . "/local/gradereport/locallib.php");


class local_gradereport_external extends external_api {

    public static function delete_record_by_id_parameters(): external_function_parameters {
        return new external_function_parameters(
            array(
                'recordid' => new external_value(PARAM_INT, 'record id'),
            )
        );
    }
    public static function delete_record_by_id(int $recordid): array {
        global $DB;

        $warnings = array();

        local_gradereport_delete_record($recordid);

        return array(
            'recordid' => $recordid,
            'warnings' => $warnings
        );

    }
    public static function delete_record_by_id_returns() {
        return new external_single_structure(
            array(
                'recordid' => new external_value(PARAM_INT, 'record id'),
                'warnings' => new external_warnings()
            )
        );
    }
}
<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * Get heartbeat availability..
 *
 * Maps to the official Checkly endpoint GET /v1/checks/heartbeats/{checkId}/availability.
 */
class ChecklyGetV1ChecksHeartbeatsCheckidAvailability extends AbstractChecklyTool
{
    protected const NAME = 'checkly_get_v1_checks_heartbeats_checkid_availability';
    protected const DESCRIPTION = 'Get heartbeat availability.

Official Checkly endpoint: GET /v1/checks/heartbeats/{checkId}/availability.';
    protected const PARAMETERS = array (
      'check_id' => array (
        'type' => 'string',
        'description' => 'checkId parameter.',
        'required' => true,
      ),
      'start_time' => array (
        'type' => 'string',
        'description' => 'startTime parameter.',
        'required' => false,
      ),
      'end_time' => array (
        'type' => 'string',
        'description' => 'endTime parameter.',
        'required' => false,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/v1/checks/heartbeats/{checkId}/availability';
    protected const PATH_PARAMS = array (
      'checkId' => 'check_id',
    );
    protected const QUERY_PARAMS = array (
      'startTime' => 'start_time',
      'endTime' => 'end_time',
    );
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

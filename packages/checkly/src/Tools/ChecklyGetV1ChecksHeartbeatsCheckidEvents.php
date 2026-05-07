<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * Get all events from a heartbeat..
 *
 * Maps to the official Checkly endpoint GET /v1/checks/heartbeats/{checkId}/events.
 */
class ChecklyGetV1ChecksHeartbeatsCheckidEvents extends AbstractChecklyTool
{
    protected const NAME = 'checkly_get_v1_checks_heartbeats_checkid_events';
    protected const DESCRIPTION = 'Get all events from a heartbeat.

Official Checkly endpoint: GET /v1/checks/heartbeats/{checkId}/events.';
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
      'limit' => array (
        'type' => 'number',
        'description' => 'limit parameter.',
        'required' => false,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/v1/checks/heartbeats/{checkId}/events';
    protected const PATH_PARAMS = array (
      'checkId' => 'check_id',
    );
    protected const QUERY_PARAMS = array (
      'startTime' => 'start_time',
      'endTime' => 'end_time',
      'limit' => 'limit',
    );
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

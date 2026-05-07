<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * Get a specific event by its id..
 *
 * Maps to the official Checkly endpoint GET /v1/checks/heartbeats/{checkId}/events/{id}.
 */
class ChecklyGetV1ChecksHeartbeatsCheckidEventsId extends AbstractChecklyTool
{
    protected const NAME = 'checkly_get_v1_checks_heartbeats_checkid_events_id';
    protected const DESCRIPTION = 'Get a specific event by its id.

Official Checkly endpoint: GET /v1/checks/heartbeats/{checkId}/events/{id}.';
    protected const PARAMETERS = array (
      'check_id' => array (
        'type' => 'string',
        'description' => 'checkId parameter.',
        'required' => true,
      ),
      'id' => array (
        'type' => 'string',
        'description' => 'id parameter.',
        'required' => true,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/v1/checks/heartbeats/{checkId}/events/{id}';
    protected const PATH_PARAMS = array (
      'checkId' => 'check_id',
      'id' => 'id',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

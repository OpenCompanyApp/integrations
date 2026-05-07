<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * Show Follow-ups V2.
 *
 * Maps to the official incident.io endpoint get /v2/follow_ups/{id}.
 */
class IncidentIoFollowUpsV2Show extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_follow_ups_v2_show';
    protected const DESCRIPTION = 'Show Follow-ups V2

Official incident.io endpoint: GET /v2/follow_ups/{id}

Get a single incident follow-up.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'Unique identifier for the follow-up',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v2/follow_ups/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

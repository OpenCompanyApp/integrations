<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * Show Actions V1.
 *
 * Maps to the official incident.io endpoint get /v1/actions/{id}.
 */
class IncidentIoActionsV1Show extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_actions_v1_show';
    protected const DESCRIPTION = 'Show Actions V1

Official incident.io endpoint: GET /v1/actions/{id}

Get a single incident action.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'Unique identifier for the action',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/actions/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

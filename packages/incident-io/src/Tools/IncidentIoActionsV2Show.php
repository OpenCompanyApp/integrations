<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * Show Actions V2.
 *
 * Maps to the official incident.io endpoint get /v2/actions/{id}.
 */
class IncidentIoActionsV2Show extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_actions_v2_show';
    protected const DESCRIPTION = 'Show Actions V2

Official incident.io endpoint: GET /v2/actions/{id}

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
    protected const PATH = '/v2/actions/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

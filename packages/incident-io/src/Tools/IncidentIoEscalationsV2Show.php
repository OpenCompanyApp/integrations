<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * Show Escalations V2.
 *
 * Maps to the official incident.io endpoint get /v2/escalations/{id}.
 */
class IncidentIoEscalationsV2Show extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_escalations_v2_show';
    protected const DESCRIPTION = 'Show Escalations V2

Official incident.io endpoint: GET /v2/escalations/{id}

Show a specific escalation.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'Unique ID of the escalation',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v2/escalations/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

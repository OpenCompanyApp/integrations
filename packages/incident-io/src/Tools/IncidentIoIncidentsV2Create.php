<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * Create Incidents V2.
 *
 * Maps to the official incident.io endpoint post /v2/incidents.
 */
class IncidentIoIncidentsV2Create extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_incidents_v2_create';
    protected const DESCRIPTION = 'Create Incidents V2

Official incident.io endpoint: POST /v2/incidents

Create a new incident.

Note that if the incident mode is set to "retrospective" then the new incident
will not be announced in Slack.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the incident.io API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v2/incidents';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}

<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * ShowStatusPageIncident Status Pages V2.
 *
 * Maps to the official incident.io endpoint get /v2/status_page_incidents/{status_page_incident_id}.
 */
class IncidentIoStatusPagesV2ShowStatusPageIncident extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_status_pages_v2_show_status_page_incident';
    protected const DESCRIPTION = 'ShowStatusPageIncident Status Pages V2

Official incident.io endpoint: GET /v2/status_page_incidents/{status_page_incident_id}

Show a status page incident.

This endpoint requires a valid API key but no specific scopes.';
    protected const PARAMETERS = array (
  'status_page_incident_id' =>
  array (
    'type' => 'string',
    'description' => 'ID of the status page incident',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v2/status_page_incidents/{status_page_incident_id}';
    protected const PATH_PARAMS = array (
  'status_page_incident_id' => 'status_page_incident_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

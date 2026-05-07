<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * UpdateStatusPageIncident Status Pages V2.
 *
 * Maps to the official incident.io endpoint put /v2/status_page_incidents/{status_page_incident_id}.
 */
class IncidentIoStatusPagesV2UpdateStatusPageIncident extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_status_pages_v2_update_status_page_incident';
    protected const DESCRIPTION = 'UpdateStatusPageIncident Status Pages V2

Official incident.io endpoint: PUT /v2/status_page_incidents/{status_page_incident_id}

Update a status page incident.

This endpoint requires an API key with the "Create status page incidents, status page maintenance windows, and publish status page updates" scope.';
    protected const PARAMETERS = array (
  'status_page_incident_id' =>
  array (
    'type' => 'string',
    'description' => 'ID of the status page incident',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the incident.io API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'put';
    protected const PATH = '/v2/status_page_incidents/{status_page_incident_id}';
    protected const PATH_PARAMS = array (
  'status_page_incident_id' => 'status_page_incident_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}

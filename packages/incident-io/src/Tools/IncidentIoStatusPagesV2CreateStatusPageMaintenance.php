<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * CreateStatusPageMaintenance Status Pages V2.
 *
 * Maps to the official incident.io endpoint post /v2/status_page_maintenances.
 */
class IncidentIoStatusPagesV2CreateStatusPageMaintenance extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_status_pages_v2_create_status_page_maintenance';
    protected const DESCRIPTION = 'CreateStatusPageMaintenance Status Pages V2

Official incident.io endpoint: POST /v2/status_page_maintenances

Schedule a Status Page maintenance window.

This endpoint requires an API key with the "Create status page incidents, status page maintenance windows, and publish status page updates" scope.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the incident.io API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v2/status_page_maintenances';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}

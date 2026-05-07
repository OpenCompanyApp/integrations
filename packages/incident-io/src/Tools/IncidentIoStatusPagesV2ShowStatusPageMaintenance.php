<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * ShowStatusPageMaintenance Status Pages V2.
 *
 * Maps to the official incident.io endpoint get /v2/status_page_maintenances/{status_page_maintenance_id}.
 */
class IncidentIoStatusPagesV2ShowStatusPageMaintenance extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_status_pages_v2_show_status_page_maintenance';
    protected const DESCRIPTION = 'ShowStatusPageMaintenance Status Pages V2

Official incident.io endpoint: GET /v2/status_page_maintenances/{status_page_maintenance_id}

Show a status page maintenance window.

This endpoint requires a valid API key but no specific scopes.';
    protected const PARAMETERS = array (
  'status_page_maintenance_id' =>
  array (
    'type' => 'string',
    'description' => 'ID of the status page maintenance window',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v2/status_page_maintenances/{status_page_maintenance_id}';
    protected const PATH_PARAMS = array (
  'status_page_maintenance_id' => 'status_page_maintenance_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

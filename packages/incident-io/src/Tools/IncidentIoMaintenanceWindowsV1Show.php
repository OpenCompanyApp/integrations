<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * Show MaintenanceWindows V1.
 *
 * Maps to the official incident.io endpoint get /v1/maintenance_windows/{id}.
 */
class IncidentIoMaintenanceWindowsV1Show extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_maintenance_windows_v1_show';
    protected const DESCRIPTION = 'Show MaintenanceWindows V1

Official incident.io endpoint: GET /v1/maintenance_windows/{id}

Show a particular maintenance window.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'Unique identifier of the maintenance window',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/maintenance_windows/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

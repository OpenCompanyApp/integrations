<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * Delete MaintenanceWindows V1.
 *
 * Maps to the official incident.io endpoint delete /v1/maintenance_windows/{id}.
 */
class IncidentIoMaintenanceWindowsV1Delete extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_maintenance_windows_v1_delete';
    protected const DESCRIPTION = 'Delete MaintenanceWindows V1

Official incident.io endpoint: DELETE /v1/maintenance_windows/{id}

Archives a maintenance window. Cannot archive active windows.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'Unique identifier of the maintenance window',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
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

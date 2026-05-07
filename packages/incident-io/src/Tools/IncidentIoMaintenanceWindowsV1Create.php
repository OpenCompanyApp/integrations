<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * Create MaintenanceWindows V1.
 *
 * Maps to the official incident.io endpoint post /v1/maintenance_windows.
 */
class IncidentIoMaintenanceWindowsV1Create extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_maintenance_windows_v1_create';
    protected const DESCRIPTION = 'Create MaintenanceWindows V1

Official incident.io endpoint: POST /v1/maintenance_windows

Create a new maintenance window.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the incident.io API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/maintenance_windows';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}

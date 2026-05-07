<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * List MaintenanceWindows V1.
 *
 * Maps to the official incident.io endpoint get /v1/maintenance_windows.
 */
class IncidentIoMaintenanceWindowsV1List extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_maintenance_windows_v1_list';
    protected const DESCRIPTION = 'List MaintenanceWindows V1

Official incident.io endpoint: GET /v1/maintenance_windows

List maintenance windows for your organisation.';
    protected const PARAMETERS = array (
  'page_size' =>
  array (
    'type' => 'integer',
    'description' => 'Number of maintenance windows to return per page',
  ),
  'after' =>
  array (
    'type' => 'string',
    'description' => 'The ID of the last maintenance window on the previous page',
  ),
  'status' =>
  array (
    'type' => 'string',
    'description' => 'Filter by window status: active (start_at <= now < end_at), upcoming (now < start_at), or past (end_at <= now)',
    'enum' =>
    array (
      0 => 'active',
      1 => 'upcoming',
      2 => 'past',
    ),
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/maintenance_windows';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'page_size' => 'page_size',
  'after' => 'after',
  'status' => 'status',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

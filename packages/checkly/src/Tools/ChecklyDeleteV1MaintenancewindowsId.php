<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * Permanently removes a maintenance window..
 *
 * Maps to the official Checkly endpoint DELETE /v1/maintenance-windows/{id}.
 */
class ChecklyDeleteV1MaintenancewindowsId extends AbstractChecklyTool
{
    protected const NAME = 'checkly_delete_v1_maintenancewindows_id';
    protected const DESCRIPTION = 'Permanently removes a maintenance window.

Official Checkly endpoint: DELETE /v1/maintenance-windows/{id}.';
    protected const PARAMETERS = array (
      'id' => array (
        'type' => 'integer',
        'description' => 'id parameter.',
        'required' => true,
      ),
    );
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/maintenance-windows/{id}';
    protected const PATH_PARAMS = array (
      'id' => 'id',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

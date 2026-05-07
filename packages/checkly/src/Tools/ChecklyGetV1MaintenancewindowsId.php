<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * Show details of a specific maintenance window..
 *
 * Maps to the official Checkly endpoint GET /v1/maintenance-windows/{id}.
 */
class ChecklyGetV1MaintenancewindowsId extends AbstractChecklyTool
{
    protected const NAME = 'checkly_get_v1_maintenancewindows_id';
    protected const DESCRIPTION = 'Show details of a specific maintenance window.

Official Checkly endpoint: GET /v1/maintenance-windows/{id}.';
    protected const PARAMETERS = array (
      'id' => array (
        'type' => 'integer',
        'description' => 'id parameter.',
        'required' => true,
      ),
    );
    protected const METHOD = 'GET';
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

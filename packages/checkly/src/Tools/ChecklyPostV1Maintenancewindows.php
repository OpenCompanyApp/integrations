<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * Creates a new maintenance window..
 *
 * Maps to the official Checkly endpoint POST /v1/maintenance-windows.
 */
class ChecklyPostV1Maintenancewindows extends AbstractChecklyTool
{
    protected const NAME = 'checkly_post_v1_maintenancewindows';
    protected const DESCRIPTION = 'Creates a new maintenance window.

Official Checkly endpoint: POST /v1/maintenance-windows.';
    protected const PARAMETERS = array (
      'body' => array (
        'type' => 'object',
        'description' => 'JSON request body matching the Checkly API schema.',
        'required' => false,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/v1/maintenance-windows';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

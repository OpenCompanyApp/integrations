<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * Lists all maintenance windows in your account..
 *
 * Maps to the official Checkly endpoint GET /v1/maintenance-windows.
 */
class ChecklyGetV1Maintenancewindows extends AbstractChecklyTool
{
    protected const NAME = 'checkly_get_v1_maintenancewindows';
    protected const DESCRIPTION = 'Lists all maintenance windows in your account.

Official Checkly endpoint: GET /v1/maintenance-windows.';
    protected const PARAMETERS = array (
      'limit' => array (
        'type' => 'integer',
        'description' => 'Limit the number of results',
        'required' => false,
      ),
      'page' => array (
        'type' => 'number',
        'description' => 'Page number',
        'required' => false,
      ),
      'starts_at' => array (
        'type' => 'object',
        'description' => 'Filter for items which startsAt field matches the constraint',
        'required' => false,
      ),
      'ends_at' => array (
        'type' => 'object',
        'description' => 'Filter for items which endsAt field matches the constraint',
        'required' => false,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/v1/maintenance-windows';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
      'limit' => 'limit',
      'page' => 'page',
      'startsAt' => 'starts_at',
      'endsAt' => 'ends_at',
    );
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

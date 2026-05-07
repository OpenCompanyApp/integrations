<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * Lists all current dashboards in your account..
 *
 * Maps to the official Checkly endpoint GET /v1/dashboards.
 */
class ChecklyGetV1Dashboards extends AbstractChecklyTool
{
    protected const NAME = 'checkly_get_v1_dashboards';
    protected const DESCRIPTION = 'Lists all current dashboards in your account.

Official Checkly endpoint: GET /v1/dashboards.';
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
    );
    protected const METHOD = 'GET';
    protected const PATH = '/v1/dashboards';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
      'limit' => 'limit',
      'page' => 'page',
    );
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

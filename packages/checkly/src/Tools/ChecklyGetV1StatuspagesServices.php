<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * Get all services.
 *
 * Maps to the official Checkly endpoint GET /v1/status-pages/services.
 */
class ChecklyGetV1StatuspagesServices extends AbstractChecklyTool
{
    protected const NAME = 'checkly_get_v1_statuspages_services';
    protected const DESCRIPTION = 'Get all services

Official Checkly endpoint: GET /v1/status-pages/services.';
    protected const PARAMETERS = array (
      'limit' => array (
        'type' => 'integer',
        'description' => 'limit parameter.',
        'required' => false,
      ),
      'next_id' => array (
        'type' => 'string',
        'description' => 'nextId parameter.',
        'required' => false,
      ),
      'paginated' => array (
        'type' => 'boolean',
        'description' => 'paginated parameter.',
        'required' => false,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/v1/status-pages/services';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
      'limit' => 'limit',
      'nextId' => 'next_id',
      'paginated' => 'paginated',
    );
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

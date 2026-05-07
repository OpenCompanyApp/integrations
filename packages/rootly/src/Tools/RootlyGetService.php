<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Retrieves a service.
 *
 * Maps to the official Rootly endpoint get /v1/services/{id}.
 */
class RootlyGetService extends AbstractRootlyTool
{
    protected const NAME = 'rootly_get_service';
    protected const DESCRIPTION = 'Retrieves a service

Official Rootly endpoint: GET /v1/services/{id}

Retrieves a specific service by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/services/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

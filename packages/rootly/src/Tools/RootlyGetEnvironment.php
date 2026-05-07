<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Retrieves an environment.
 *
 * Maps to the official Rootly endpoint get /v1/environments/{id}.
 */
class RootlyGetEnvironment extends AbstractRootlyTool
{
    protected const NAME = 'rootly_get_environment';
    protected const DESCRIPTION = 'Retrieves an environment

Official Rootly endpoint: GET /v1/environments/{id}

Retrieves a specific environment by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/environments/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

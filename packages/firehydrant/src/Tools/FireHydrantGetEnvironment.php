<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Get an environment.
 *
 * Maps to the official FireHydrant endpoint get /v1/environments/{environment_id}.
 */
class FireHydrantGetEnvironment extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_get_environment';
    protected const DESCRIPTION = 'Get an environment

Official FireHydrant endpoint: GET /v1/environments/{environment_id}

Retrieves a single environment by ID';
    protected const PARAMETERS = array (
  'environment_id' =>
  array (
    'type' => 'string',
    'description' => 'Environment UUID or slug',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/environments/{environment_id}';
    protected const PATH_PARAMS = array (
  'environment_id' => 'environment_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

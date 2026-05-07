<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * List functionalities for an environment.
 *
 * Maps to the official FireHydrant endpoint get /v1/environments/{environment_id}/functionalities.
 */
class FireHydrantListEnvironmentFunctionalities extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_environment_functionalities';
    protected const DESCRIPTION = 'List functionalities for an environment

Official FireHydrant endpoint: GET /v1/environments/{environment_id}/functionalities

List functionalities for an environment';
    protected const PARAMETERS = array (
  'environment_id' =>
  array (
    'type' => 'string',
    'description' => 'environment_id parameter.',
    'required' => true,
  ),
  'page' =>
  array (
    'type' => 'integer',
    'description' => 'page parameter.',
  ),
  'per_page' =>
  array (
    'type' => 'integer',
    'description' => 'per_page parameter.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/environments/{environment_id}/functionalities';
    protected const PATH_PARAMS = array (
  'environment_id' => 'environment_id',
);
    protected const QUERY_PARAMS = array (
  'page' => 'page',
  'per_page' => 'per_page',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

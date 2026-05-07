<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * List services for an environment.
 *
 * Maps to the official FireHydrant endpoint get /v1/environments/{environment_id}/services.
 */
class FireHydrantListEnvironmentServices extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_environment_services';
    protected const DESCRIPTION = 'List services for an environment

Official FireHydrant endpoint: GET /v1/environments/{environment_id}/services

List services for an environment';
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
    protected const PATH = '/v1/environments/{environment_id}/services';
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

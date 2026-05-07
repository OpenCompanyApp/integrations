<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * List environments for a service.
 *
 * Maps to the official FireHydrant endpoint get /v1/services/{service_id}/environments.
 */
class FireHydrantListServiceEnvironments extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_service_environments';
    protected const DESCRIPTION = 'List environments for a service

Official FireHydrant endpoint: GET /v1/services/{service_id}/environments

List environments for a service';
    protected const PARAMETERS = array (
  'service_id' =>
  array (
    'type' => 'string',
    'description' => 'service_id parameter.',
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
    protected const PATH = '/v1/services/{service_id}/environments';
    protected const PATH_PARAMS = array (
  'service_id' => 'service_id',
);
    protected const QUERY_PARAMS = array (
  'page' => 'page',
  'per_page' => 'per_page',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

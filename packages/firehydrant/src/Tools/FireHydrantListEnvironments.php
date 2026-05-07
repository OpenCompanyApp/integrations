<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * List environments.
 *
 * Maps to the official FireHydrant endpoint get /v1/environments.
 */
class FireHydrantListEnvironments extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_environments';
    protected const DESCRIPTION = 'List environments

Official FireHydrant endpoint: GET /v1/environments

List all of the environments that have been added to the organiation';
    protected const PARAMETERS = array (
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
  'query' =>
  array (
    'type' => 'string',
    'description' => 'A query to search environments by their name or description',
  ),
  'name' =>
  array (
    'type' => 'string',
    'description' => 'A query to search environments by their name',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/environments';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'page' => 'page',
  'per_page' => 'per_page',
  'query' => 'query',
  'name' => 'name',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

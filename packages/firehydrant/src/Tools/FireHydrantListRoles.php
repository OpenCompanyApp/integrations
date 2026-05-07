<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Get all roles.
 *
 * Maps to the official FireHydrant endpoint get /v1/roles.
 */
class FireHydrantListRoles extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_roles';
    protected const DESCRIPTION = 'Get all roles

Official FireHydrant endpoint: GET /v1/roles

Get all roles in the organization';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'string',
    'description' => 'A search query to filter roles by name and slug.',
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
    protected const PATH = '/v1/roles';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'query' => 'query',
  'page' => 'page',
  'per_page' => 'per_page',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

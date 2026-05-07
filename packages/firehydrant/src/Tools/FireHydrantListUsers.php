<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * List users.
 *
 * Maps to the official FireHydrant endpoint get /v1/users.
 */
class FireHydrantListUsers extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_users';
    protected const DESCRIPTION = 'List users

Official FireHydrant endpoint: GET /v1/users

Retrieve a list of all users in an organization';
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
    'description' => 'Text string of a query to filter users by name or email',
  ),
  'name' =>
  array (
    'type' => 'string',
    'description' => 'Text string of a query to filter users by name',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/users';
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

<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * List all roles.
 *
 * Maps to the official Fivetran endpoint get /v1/roles.
 */
class FivetranListAllRoles extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_list_all_roles';
    protected const DESCRIPTION = 'List all roles

Official Fivetran endpoint: GET /v1/roles

Returns a list of all predefined and custom roles within your Fivetran account.';
    protected const PARAMETERS = array (
  'cursor' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `cursor` from the official Fivetran API operation. Paging cursor, [read more about pagination](https://fivetran.com/docs/rest-api/pagination)',
  ),
  'limit' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `limit` from the official Fivetran API operation. Number of records to fetch per page. Accepts a number in the range 1..1000; the default value is 100.',
  ),
  'accept' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Header parameter `Accept` from the official Fivetran API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/roles';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'cursor' => 'cursor',
  'limit' => 'limit',
);
    protected const HEADER_PARAMS = array (
  'Accept' => 'accept',
);
    protected const BODY_REQUIRED = false;
}

<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * List All Connections.
 *
 * Maps to the official Fivetran endpoint get /v1/connections.
 */
class FivetranListConnections extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_list_connections';
    protected const DESCRIPTION = 'List All Connections

Official Fivetran endpoint: GET /v1/connections

Returns a list of all accessible connections within your Fivetran account.';
    protected const PARAMETERS = array (
  'group_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `group_id` from the official Fivetran API operation. Specify the group identifier to filter connections by group',
  ),
  'schema' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `schema` from the official Fivetran API operation. Specify the schema name to filter connections by schema',
  ),
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
    protected const PATH = '/v1/connections';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'group_id' => 'group_id',
  'schema' => 'schema',
  'cursor' => 'cursor',
  'limit' => 'limit',
);
    protected const HEADER_PARAMS = array (
  'Accept' => 'accept',
);
    protected const BODY_REQUIRED = false;
}

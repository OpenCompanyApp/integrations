<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * List All Connections within a Group.
 *
 * Maps to the official Fivetran endpoint get /v1/groups/{groupId}/connections.
 */
class FivetranListAllConnectionsInGroup extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_list_all_connections_in_group';
    protected const DESCRIPTION = 'List All Connections within a Group

Official Fivetran endpoint: GET /v1/groups/{groupId}/connections

Returns a list of information about all connections within a group in your Fivetran account.';
    protected const PARAMETERS = array (
  'group_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `groupId` from the official Fivetran API operation. The unique identifier for the group within the Fivetran system.',
  ),
  'schema' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `schema` from the official Fivetran API operation. The name used both as the connection\'s name within the Fivetran system and as the source schema\'s name within your destination.',
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
    protected const PATH = '/v1/groups/{groupId}/connections';
    protected const PATH_PARAMS = array (
  'groupId' => 'group_id',
);
    protected const QUERY_PARAMS = array (
  'schema' => 'schema',
  'cursor' => 'cursor',
  'limit' => 'limit',
);
    protected const HEADER_PARAMS = array (
  'Accept' => 'accept',
);
    protected const BODY_REQUIRED = false;
}

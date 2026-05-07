<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * List All Users within a Group.
 *
 * Maps to the official Fivetran endpoint get /v1/groups/{groupId}/users.
 */
class FivetranListAllUsersInGroup extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_list_all_users_in_group';
    protected const DESCRIPTION = 'List All Users within a Group

Official Fivetran endpoint: GET /v1/groups/{groupId}/users

Returns a list of information about all users within a group in your Fivetran account.';
    protected const PARAMETERS = array (
  'group_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `groupId` from the official Fivetran API operation. The unique identifier for the group within the Fivetran system.',
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
  'active' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Query parameter `active` from the official Fivetran API operation. Indicates whether to return only enabled users (true) or not (false). By default, both enabled (allowed to log in) and suspended users ar...',
  ),
  'accept' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Header parameter `Accept` from the official Fivetran API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/groups/{groupId}/users';
    protected const PATH_PARAMS = array (
  'groupId' => 'group_id',
);
    protected const QUERY_PARAMS = array (
  'cursor' => 'cursor',
  'limit' => 'limit',
  'active' => 'active',
);
    protected const HEADER_PARAMS = array (
  'Accept' => 'accept',
);
    protected const BODY_REQUIRED = false;
}

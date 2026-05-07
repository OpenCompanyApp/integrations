<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Add a User to a Group.
 *
 * Maps to the official Fivetran endpoint post /v1/groups/{groupId}/users.
 */
class FivetranAddUserToGroup extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_add_user_to_group';
    protected const DESCRIPTION = 'Add a User to a Group

Official Fivetran endpoint: POST /v1/groups/{groupId}/users

Adds an existing user to a group in your Fivetran account.';
    protected const PARAMETERS = array (
  'group_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `groupId` from the official Fivetran API operation. The unique identifier for the group within the Fivetran system.',
  ),
  'accept' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Header parameter `Accept` from the official Fivetran API operation.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Fivetran API request schema.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/groups/{groupId}/users';
    protected const PATH_PARAMS = array (
  'groupId' => 'group_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
  'Accept' => 'accept',
);
    protected const BODY_REQUIRED = false;
}

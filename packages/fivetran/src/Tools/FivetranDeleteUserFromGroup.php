<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Remove a User from a Group.
 *
 * Maps to the official Fivetran endpoint delete /v1/groups/{groupId}/users/{userId}.
 */
class FivetranDeleteUserFromGroup extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_delete_user_from_group';
    protected const DESCRIPTION = 'Remove a User from a Group

Official Fivetran endpoint: DELETE /v1/groups/{groupId}/users/{userId}

Removes an existing user from a group in your Fivetran account.';
    protected const PARAMETERS = array (
  'group_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `groupId` from the official Fivetran API operation. The unique identifier for the group within the Fivetran system.',
  ),
  'user_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `userId` from the official Fivetran API operation. The unique identifier for the user within the account.',
  ),
  'accept' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Header parameter `Accept` from the official Fivetran API operation.',
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/groups/{groupId}/users/{userId}';
    protected const PATH_PARAMS = array (
  'groupId' => 'group_id',
  'userId' => 'user_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
  'Accept' => 'accept',
);
    protected const BODY_REQUIRED = false;
}

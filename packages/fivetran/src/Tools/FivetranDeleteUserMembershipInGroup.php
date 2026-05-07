<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Delete Group Membership.
 *
 * Maps to the official Fivetran endpoint delete /v1/users/{userId}/groups/{groupId}.
 */
class FivetranDeleteUserMembershipInGroup extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_delete_user_membership_in_group';
    protected const DESCRIPTION = 'Delete Group Membership

Official Fivetran endpoint: DELETE /v1/users/{userId}/groups/{groupId}

Removes user from a group.';
    protected const PARAMETERS = array (
  'user_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `userId` from the official Fivetran API operation. The unique identifier for the user within the account.',
  ),
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
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/users/{userId}/groups/{groupId}';
    protected const PATH_PARAMS = array (
  'userId' => 'user_id',
  'groupId' => 'group_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
  'Accept' => 'accept',
);
    protected const BODY_REQUIRED = false;
}

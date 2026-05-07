<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Delete Group Membership.
 *
 * Maps to the official Fivetran endpoint delete /v1/teams/{teamId}/groups/{groupId}.
 */
class FivetranDeleteTeamMembershipInGroup extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_delete_team_membership_in_group';
    protected const DESCRIPTION = 'Delete Group Membership

Official Fivetran endpoint: DELETE /v1/teams/{teamId}/groups/{groupId}

Removes a team\'s membership in a group.';
    protected const PARAMETERS = array (
  'team_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `teamId` from the official Fivetran API operation. The unique identifier for the team within the account.',
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
    protected const PATH = '/v1/teams/{teamId}/groups/{groupId}';
    protected const PATH_PARAMS = array (
  'teamId' => 'team_id',
  'groupId' => 'group_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
  'Accept' => 'accept',
);
    protected const BODY_REQUIRED = false;
}

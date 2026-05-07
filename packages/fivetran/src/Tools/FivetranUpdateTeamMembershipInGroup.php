<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Update Group Membership.
 *
 * Maps to the official Fivetran endpoint patch /v1/teams/{teamId}/groups/{groupId}.
 */
class FivetranUpdateTeamMembershipInGroup extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_update_team_membership_in_group';
    protected const DESCRIPTION = 'Update Group Membership

Official Fivetran endpoint: PATCH /v1/teams/{teamId}/groups/{groupId}

Updates team membership in a group.';
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
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Fivetran API request schema.',
  ),
);
    protected const METHOD = 'patch';
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

<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Delete Team from Account.
 *
 * Maps to the official Fivetran endpoint delete /v1/teams/{teamId}/role.
 */
class FivetranDeleteTeamMembershipInAccount extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_delete_team_membership_in_account';
    protected const DESCRIPTION = 'Delete Team from Account

Official Fivetran endpoint: DELETE /v1/teams/{teamId}/role

Removes a team from your Fivetran account';
    protected const PARAMETERS = array (
  'team_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `teamId` from the official Fivetran API operation. The unique identifier for the team within the account.',
  ),
  'accept' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Header parameter `Accept` from the official Fivetran API operation.',
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/teams/{teamId}/role';
    protected const PATH_PARAMS = array (
  'teamId' => 'team_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
  'Accept' => 'accept',
);
    protected const BODY_REQUIRED = false;
}

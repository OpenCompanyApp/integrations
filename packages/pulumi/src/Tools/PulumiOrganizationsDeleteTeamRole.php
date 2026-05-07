<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * DeleteTeamRole.
 *
 * Maps to the official Pulumi Cloud endpoint delete /api/orgs/{orgName}/teams/{teamName}/roles/{roleID}.
 */
class PulumiOrganizationsDeleteTeamRole extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_delete_team_role';
    protected const DESCRIPTION = 'DeleteTeamRole

Official Pulumi Cloud endpoint: DELETE /api/orgs/{orgName}/teams/{teamName}/roles/{roleID}

Removes a custom role assignment from a team. This revokes the permissions that were granted to team members through the role. Currently only one role can be assigned per team.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
  'team_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `teamName` from the official Pulumi Cloud API operation. The team name',
  ),
  'role_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `roleID` from the official Pulumi Cloud API operation. The role identifier',
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/api/orgs/{orgName}/teams/{teamName}/roles/{roleID}';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'teamName' => 'team_name',
  'roleID' => 'role_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

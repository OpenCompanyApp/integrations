<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * UpdateTeamRoles.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/orgs/{orgName}/teams/{teamName}/roles/{roleID}.
 */
class PulumiOrganizationsUpdateTeamRoles extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_update_team_roles';
    protected const DESCRIPTION = 'UpdateTeamRoles

Official Pulumi Cloud endpoint: POST /api/orgs/{orgName}/teams/{teamName}/roles/{roleID}

UpdateTeamRoles upserts the role assigned to a team since we currently only support a 1:1 mapping of teams to roles.';
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
    protected const METHOD = 'post';
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

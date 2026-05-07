<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * ListTeamRoles.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/orgs/{orgName}/teams/{teamName}/roles.
 */
class PulumiOrganizationsListTeamRoles extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_list_team_roles';
    protected const DESCRIPTION = 'ListTeamRoles

Official Pulumi Cloud endpoint: GET /api/orgs/{orgName}/teams/{teamName}/roles

ListTeamRoles will list the roles for a team. For now, this will always be a list of one, since we currently only support one role per team.';
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
);
    protected const METHOD = 'get';
    protected const PATH = '/api/orgs/{orgName}/teams/{teamName}/roles';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'teamName' => 'team_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

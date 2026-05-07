<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * GetTeam.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/orgs/{orgName}/teams/{teamName}.
 */
class PulumiOrganizationsGetTeam extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_get_team';
    protected const DESCRIPTION = 'GetTeam

Official Pulumi Cloud endpoint: GET /api/orgs/{orgName}/teams/{teamName}

Retrieves detailed information about a specific team within an organization. The response includes the team name, display name, description, team type (Pulumi-managed, GitHub-backed, or GitLab-backed), list of members with their roles (team admin or team member), and the stack permissions granted to the team. Teams provide a centralized way to manage stack access for groups of users.';
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
    protected const PATH = '/api/orgs/{orgName}/teams/{teamName}';
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

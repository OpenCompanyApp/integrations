<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * ListGitHubOrganizationTeams.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/user/github/{ghOrgName}/teams.
 */
class PulumiUsersListGitHubOrganizationTeams extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_users_list_git_hub_organization_teams';
    protected const DESCRIPTION = 'ListGitHubOrganizationTeams

Official Pulumi Cloud endpoint: GET /api/user/github/{ghOrgName}/teams

ListGitHubOrganizationTeams returns all GitHub teams the requesting user has access to see.';
    protected const PARAMETERS = array (
  'gh_org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `ghOrgName` from the official Pulumi Cloud API operation. The GitHub organization name',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/user/github/{ghOrgName}/teams';
    protected const PATH_PARAMS = array (
  'ghOrgName' => 'gh_org_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

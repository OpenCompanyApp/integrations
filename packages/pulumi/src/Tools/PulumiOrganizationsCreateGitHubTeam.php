<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * CreateGitHubTeam.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/orgs/{orgName}/teams/github.
 */
class PulumiOrganizationsCreateGitHubTeam extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_create_git_hub_team';
    protected const DESCRIPTION = 'CreateGitHubTeam

Official Pulumi Cloud endpoint: POST /api/orgs/{orgName}/teams/github

Creates a new Pulumi team backed by a GitHub team. When an organization is backed by GitHub, existing GitHub teams can be imported into Pulumi to manage stack permissions. Membership is managed through GitHub while stack access permissions are controlled within Pulumi Cloud. The request must include the GitHub team ID. Returns 409 if a team with the same name already exists.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Pulumi Cloud API request schema.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/orgs/{orgName}/teams/github';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

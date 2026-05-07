<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * CreateTeamToken.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/orgs/{orgName}/teams/{teamName}/tokens.
 */
class PulumiOrganizationsCreateTeamToken extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_create_team_token';
    protected const DESCRIPTION = 'CreateTeamToken

Official Pulumi Cloud endpoint: POST /api/orgs/{orgName}/teams/{teamName}/tokens

Generates a new access token scoped to a specific team within an organization. Team tokens inherit the stack permissions assigned to the team, making them suitable for CI/CD pipelines that need access limited to a specific set of stacks. The `name` field must be unique across the organization (including deleted tokens) and cannot exceed 40 characters. The `expires` field accepts a unix epoch timestamp up to two years from the present, or `0` for no expiry (default). **Important:** The token value in the response is only returned once at creation time and cannot be retrieved later.';
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
  'reason' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `reason` from the official Pulumi Cloud API operation. Audit log reason for creating this token',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Pulumi Cloud API request schema.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/orgs/{orgName}/teams/{teamName}/tokens';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'teamName' => 'team_name',
);
    protected const QUERY_PARAMS = array (
  'reason' => 'reason',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

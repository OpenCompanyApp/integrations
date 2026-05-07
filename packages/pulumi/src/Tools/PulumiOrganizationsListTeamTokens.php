<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * ListTeamTokens.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/orgs/{orgName}/teams/{teamName}/tokens.
 */
class PulumiOrganizationsListTeamTokens extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_list_team_tokens';
    protected const DESCRIPTION = 'ListTeamTokens

Official Pulumi Cloud endpoint: GET /api/orgs/{orgName}/teams/{teamName}/tokens

Retrieves all access tokens for a specific team. Team tokens inherit the stack permissions assigned to the team, providing scoped CI/CD automation access. The response includes token metadata such as name, description, creation date, last used date, and expiration status. The actual token values are never returned after initial creation. An optional filter parameter can include expired tokens.';
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
  'filter' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `filter` from the official Pulumi Cloud API operation. Filter tokens by status (e.g., include expired tokens)',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/orgs/{orgName}/teams/{teamName}/tokens';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'teamName' => 'team_name',
);
    protected const QUERY_PARAMS = array (
  'filter' => 'filter',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * DeleteTeamToken.
 *
 * Maps to the official Pulumi Cloud endpoint delete /api/orgs/{orgName}/teams/{teamName}/tokens/{tokenId}.
 */
class PulumiOrganizationsDeleteTeamToken extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_delete_team_token';
    protected const DESCRIPTION = 'DeleteTeamToken

Official Pulumi Cloud endpoint: DELETE /api/orgs/{orgName}/teams/{teamName}/tokens/{tokenId}

Permanently revokes and deletes a team access token. Any CI/CD pipelines or automation using this token will immediately lose access to the stacks assigned to the team. This action cannot be undone.';
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
  'token_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `tokenId` from the official Pulumi Cloud API operation. The access token identifier',
  ),
  'reason' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `reason` from the official Pulumi Cloud API operation. Audit log reason for deleting this token',
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/api/orgs/{orgName}/teams/{teamName}/tokens/{tokenId}';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'teamName' => 'team_name',
  'tokenId' => 'token_id',
);
    protected const QUERY_PARAMS = array (
  'reason' => 'reason',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * UpdateTeam.
 *
 * Maps to the official Pulumi Cloud endpoint patch /api/orgs/{orgName}/teams/{teamName}.
 */
class PulumiOrganizationsUpdateTeam extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_update_team';
    protected const DESCRIPTION = 'UpdateTeam

Official Pulumi Cloud endpoint: PATCH /api/orgs/{orgName}/teams/{teamName}

Updates a team\'s membership and configuration. This multi-purpose endpoint supports several operations: **Update membership:** Use `member` (username) and `memberAction` (`add` or `remove`) to manage team members. **Grant stack access:** Use `addStackPermission` with `projectName`, `stackName`, and `permission` (integer: `101` = read, `102` = edit, `103` = admin). **Remove stack access:** Use `removeStack` with `projectName` and `stackName`. Members added to a team inherit the team\'s stack permissions. Teams are not available to individual (single-user) organizations.';
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
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Pulumi Cloud API request schema.',
  ),
);
    protected const METHOD = 'patch';
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

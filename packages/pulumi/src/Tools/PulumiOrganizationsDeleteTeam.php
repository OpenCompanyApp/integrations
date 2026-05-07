<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * DeleteTeam.
 *
 * Maps to the official Pulumi Cloud endpoint delete /api/orgs/{orgName}/teams/{teamName}.
 */
class PulumiOrganizationsDeleteTeam extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_delete_team';
    protected const DESCRIPTION = 'DeleteTeam

Official Pulumi Cloud endpoint: DELETE /api/orgs/{orgName}/teams/{teamName}

Permanently removes a team from an organization. All stack permission grants assigned to the team are revoked, and team members lose any access that was granted solely through team membership. Team tokens associated with the team are also invalidated. This action cannot be undone.';
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
    protected const METHOD = 'delete';
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

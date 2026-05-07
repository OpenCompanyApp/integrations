<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * EnableTeamRoles.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/orgs/{orgName}/teams/{teamName}/enable-team-roles.
 */
class PulumiOrganizationsEnableTeamRoles extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_enable_team_roles';
    protected const DESCRIPTION = 'EnableTeamRoles

Official Pulumi Cloud endpoint: POST /api/orgs/{orgName}/teams/{teamName}/enable-team-roles

Enables custom role-based access control for a team. Once enabled, the team can be assigned custom roles that define fine-grained permissions beyond the default team admin and team member roles. Returns the created role descriptor.';
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
    protected const METHOD = 'post';
    protected const PATH = '/api/orgs/{orgName}/teams/{teamName}/enable-team-roles';
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

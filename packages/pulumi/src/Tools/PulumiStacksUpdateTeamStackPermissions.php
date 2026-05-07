<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * UpdateTeamStackPermissions.
 *
 * Maps to the official Pulumi Cloud endpoint patch /api/console/stacks/{orgName}/{projectName}/{stackName}/teams/{teamName}.
 */
class PulumiStacksUpdateTeamStackPermissions extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_stacks_update_team_stack_permissions';
    protected const DESCRIPTION = 'UpdateTeamStackPermissions

Official Pulumi Cloud endpoint: PATCH /api/console/stacks/{orgName}/{projectName}/{stackName}/teams/{teamName}

Modifies the permissions that a specific team has for the referenced stack. This allows setting the team\'s permission level (read, write, admin) for a single stack without affecting the team\'s permissions on other stacks. Returns 400 if the permission level is invalid or the team does not have the required base permissions. Returns 403 if the caller lacks permission to update the team. Returns 404 if the team does not exist.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
  'project_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `projectName` from the official Pulumi Cloud API operation. The project name',
  ),
  'stack_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `stackName` from the official Pulumi Cloud API operation. The stack name',
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
    protected const PATH = '/api/console/stacks/{orgName}/{projectName}/{stackName}/teams/{teamName}';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'projectName' => 'project_name',
  'stackName' => 'stack_name',
  'teamName' => 'team_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

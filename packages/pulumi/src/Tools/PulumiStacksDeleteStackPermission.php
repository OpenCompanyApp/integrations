<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * DeleteStackPermission.
 *
 * Maps to the official Pulumi Cloud endpoint delete /api/stacks/{orgName}/{projectName}/{stackName}/collaborators/{userName}.
 */
class PulumiStacksDeleteStackPermission extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_stacks_delete_stack_permission';
    protected const DESCRIPTION = 'DeleteStackPermission

Official Pulumi Cloud endpoint: DELETE /api/stacks/{orgName}/{projectName}/{stackName}/collaborators/{userName}

Removes a specific user\'s direct permission to access a stack. This only removes permissions explicitly granted to the user; permissions inherited from team membership or organization-level defaults are not affected. Returns 404 if the user does not exist.';
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
  'user_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `userName` from the official Pulumi Cloud API operation. The user name',
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/api/stacks/{orgName}/{projectName}/{stackName}/collaborators/{userName}';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'projectName' => 'project_name',
  'stackName' => 'stack_name',
  'userName' => 'user_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

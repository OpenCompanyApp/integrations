<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * ListMemberStackPermissions.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/console/orgs/{orgName}/members/{userLogin}/stacks/{projectName}/{stackName}.
 */
class PulumiStacksListMemberStackPermissions extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_stacks_list_member_stack_permissions';
    protected const DESCRIPTION = 'ListMemberStackPermissions

Official Pulumi Cloud endpoint: GET /api/console/orgs/{orgName}/members/{userLogin}/stacks/{projectName}/{stackName}

Lists all permissions granted to a specific organization member for a given stack. The response provides a comprehensive view of the user\'s access, including permissions inherited from the organization\'s default role, permissions granted through team memberships, and permissions explicitly assigned to the user. Returns 404 if the user does not exist.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
  'user_login' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `userLogin` from the official Pulumi Cloud API operation. The user login',
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
);
    protected const METHOD = 'get';
    protected const PATH = '/api/console/orgs/{orgName}/members/{userLogin}/stacks/{projectName}/{stackName}';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'userLogin' => 'user_login',
  'projectName' => 'project_name',
  'stackName' => 'stack_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

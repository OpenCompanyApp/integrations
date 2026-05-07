<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * ListStackPermissions.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/stacks/{orgName}/{projectName}/{stackName}/collaborators.
 */
class PulumiStacksListStackPermissions extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_stacks_list_stack_permissions';
    protected const DESCRIPTION = 'ListStackPermissions

Official Pulumi Cloud endpoint: GET /api/stacks/{orgName}/{projectName}/{stackName}/collaborators

Lists all collaborators for a stack, including their permission levels. This includes collaborators who have been invited but have not yet accepted their invitations. The response includes each collaborator\'s username and their permission level for the stack. This endpoint is deprecated.';
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
);
    protected const METHOD = 'get';
    protected const PATH = '/api/stacks/{orgName}/{projectName}/{stackName}/collaborators';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'projectName' => 'project_name',
  'stackName' => 'stack_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

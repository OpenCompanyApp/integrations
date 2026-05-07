<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * DeleteStack.
 *
 * Maps to the official Pulumi Cloud endpoint delete /api/stacks/{orgName}/{projectName}/{stackName}.
 */
class PulumiStacksDeleteStack extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_stacks_delete_stack';
    protected const DESCRIPTION = 'DeleteStack

Official Pulumi Cloud endpoint: DELETE /api/stacks/{orgName}/{projectName}/{stackName}

Removes a stack from Pulumi Cloud. By default, the stack must have no resources remaining; attempting to delete a stack that still manages resources will fail. Use the \'force\' query parameter set to true to override this check and force deletion even when resources remain. The deletion is a soft-delete that hides the stack from normal queries. Returns 204 with no content on success.';
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
  'force' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Query parameter `force` from the official Pulumi Cloud API operation. When true, forces deletion even if the stack still has resources',
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/api/stacks/{orgName}/{projectName}/{stackName}';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'projectName' => 'project_name',
  'stackName' => 'stack_name',
);
    protected const QUERY_PARAMS = array (
  'force' => 'force',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

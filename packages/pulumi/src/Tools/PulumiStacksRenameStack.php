<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * RenameStack.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/stacks/{orgName}/{projectName}/{stackName}/rename.
 */
class PulumiStacksRenameStack extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_stacks_rename_stack';
    protected const DESCRIPTION = 'RenameStack

Official Pulumi Cloud endpoint: POST /api/stacks/{orgName}/{projectName}/{stackName}/rename

Changes an existing stack\'s name to a new value. The request body must include the desired new name. The rename may also change the project name. Returns 400 if the request body does not specify a rename. Returns 409 if another update is currently in progress on the stack, since renaming requires exclusive access.';
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
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Pulumi Cloud API request schema.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/stacks/{orgName}/{projectName}/{stackName}/rename';
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

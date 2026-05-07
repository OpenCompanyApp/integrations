<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * ImportStack.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/stacks/{orgName}/{projectName}/{stackName}/import.
 */
class PulumiStacksImportStack extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_stacks_import_stack';
    protected const DESCRIPTION = 'ImportStack

Official Pulumi Cloud endpoint: POST /api/stacks/{orgName}/{projectName}/{stackName}/import

Imports a deployment state snapshot into the specified stack, replacing the current state. The request body must contain a complete untyped deployment object with the same format returned by the ExportStack endpoint. This is commonly used for state migration between backends, state repair, or restoring from backup. Returns 400 if the deployment contains encrypted secrets from a different stack. Returns 409 if another update is currently in progress on the stack.';
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
    protected const PATH = '/api/stacks/{orgName}/{projectName}/{stackName}/import';
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

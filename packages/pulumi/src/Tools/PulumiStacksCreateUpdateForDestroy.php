<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * CreateUpdateForDestroy.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/stacks/{orgName}/{projectName}/{stackName}/destroy.
 */
class PulumiStacksCreateUpdateForDestroy extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_stacks_create_update_for_destroy';
    protected const DESCRIPTION = 'CreateUpdateForDestroy

Official Pulumi Cloud endpoint: POST /api/stacks/{orgName}/{projectName}/{stackName}/destroy

Creates a new destroy update for the given stack. A destroy update tears down all resources managed by the stack. This only creates the update record; the update must subsequently be started via the StartUpdateForDestroy endpoint. Enforces stack update concurrency checks to prevent conflicting simultaneous operations.';
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
    protected const PATH = '/api/stacks/{orgName}/{projectName}/{stackName}/destroy';
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

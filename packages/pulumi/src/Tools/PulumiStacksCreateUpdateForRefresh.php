<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * CreateUpdateForRefresh.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/stacks/{orgName}/{projectName}/{stackName}/refresh.
 */
class PulumiStacksCreateUpdateForRefresh extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_stacks_create_update_for_refresh';
    protected const DESCRIPTION = 'CreateUpdateForRefresh

Official Pulumi Cloud endpoint: POST /api/stacks/{orgName}/{projectName}/{stackName}/refresh

Creates a new refresh update for the given stack. A refresh synchronizes the stack\'s state with the actual state of the cloud resources, detecting any drift. This only creates the update record; the update must subsequently be started via the StartUpdateForRefresh endpoint. Enforces stack update concurrency checks.';
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
    protected const PATH = '/api/stacks/{orgName}/{projectName}/{stackName}/refresh';
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

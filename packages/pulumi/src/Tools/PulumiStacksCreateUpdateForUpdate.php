<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * CreateUpdateForUpdate.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/stacks/{orgName}/{projectName}/{stackName}/update.
 */
class PulumiStacksCreateUpdateForUpdate extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_stacks_create_update_for_update';
    protected const DESCRIPTION = 'CreateUpdateForUpdate

Official Pulumi Cloud endpoint: POST /api/stacks/{orgName}/{projectName}/{stackName}/update

Creates a new standard update (pulumi up) for the given stack. A standard update deploys changes to the stack\'s infrastructure by creating, updating, or deleting resources as needed. This only creates the update record; the update must subsequently be started via the StartUpdateForUpdate endpoint. Enforces stack update concurrency checks to prevent conflicting simultaneous operations.';
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
    protected const PATH = '/api/stacks/{orgName}/{projectName}/{stackName}/update';
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

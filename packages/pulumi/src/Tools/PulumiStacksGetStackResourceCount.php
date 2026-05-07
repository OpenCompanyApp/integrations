<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * GetStackResourceCount.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/stacks/{orgName}/{projectName}/{stackName}/resources/count.
 */
class PulumiStacksGetStackResourceCount extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_stacks_get_stack_resource_count';
    protected const DESCRIPTION = 'GetStackResourceCount

Official Pulumi Cloud endpoint: GET /api/stacks/{orgName}/{projectName}/{stackName}/resources/count

Returns the total number of resources currently managed by the stack, based on the most recent update. The response includes the resource count and the stack version number. This is a lightweight endpoint for checking stack size without retrieving full resource details.';
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
    protected const PATH = '/api/stacks/{orgName}/{projectName}/{stackName}/resources/count';
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

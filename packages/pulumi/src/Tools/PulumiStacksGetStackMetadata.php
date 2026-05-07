<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * GetStackMetadata.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/stacks/{orgName}/{projectName}/{stackName}/metadata.
 */
class PulumiStacksGetStackMetadata extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_stacks_get_stack_metadata';
    protected const DESCRIPTION = 'GetStackMetadata

Official Pulumi Cloud endpoint: GET /api/stacks/{orgName}/{projectName}/{stackName}/metadata

Returns metadata about a stack including the requesting user\'s permission level and the stack\'s notification settings (such as whether to notify on update success or failure). This endpoint provides access control and configuration metadata without returning the full stack details.';
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
    protected const PATH = '/api/stacks/{orgName}/{projectName}/{stackName}/metadata';
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

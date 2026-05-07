<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * GetStackResource.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/stacks/{orgName}/{projectName}/{stackName}/resources/{version}/{urn}.
 */
class PulumiStacksGetStackResource extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_stacks_get_stack_resource';
    protected const DESCRIPTION = 'GetStackResource

Official Pulumi Cloud endpoint: GET /api/stacks/{orgName}/{projectName}/{stackName}/resources/{version}/{urn}

Returns detailed information about a specific resource identified by its URN at a specific historical update version. The response includes the resource type, provider, inputs, outputs, and dependency information as they existed at that version. Returns 404 if the resource or version does not exist.';
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
  'version' =>
  array (
    'type' => 'integer',
    'required' => true,
    'description' => 'Path parameter `version` from the official Pulumi Cloud API operation. The stack update version number',
  ),
  'urn' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `urn` from the official Pulumi Cloud API operation. The resource URN',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/stacks/{orgName}/{projectName}/{stackName}/resources/{version}/{urn}';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'projectName' => 'project_name',
  'stackName' => 'stack_name',
  'version' => 'version',
  'urn' => 'urn',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

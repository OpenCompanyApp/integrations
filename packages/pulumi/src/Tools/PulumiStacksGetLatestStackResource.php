<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * GetLatestStackResource.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/stacks/{orgName}/{projectName}/{stackName}/resources/latest/{urn}.
 */
class PulumiStacksGetLatestStackResource extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_stacks_get_latest_stack_resource';
    protected const DESCRIPTION = 'GetLatestStackResource

Official Pulumi Cloud endpoint: GET /api/stacks/{orgName}/{projectName}/{stackName}/resources/latest/{urn}

Returns detailed information about a specific resource identified by its URN from the most recent stack update. The response includes the resource type, provider, inputs, outputs, and dependency information. Returns 404 if no resource with the given URN exists in the latest state.';
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
  'urn' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `urn` from the official Pulumi Cloud API operation. The resource URN',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/stacks/{orgName}/{projectName}/{stackName}/resources/latest/{urn}';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'projectName' => 'project_name',
  'stackName' => 'stack_name',
  'urn' => 'urn',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

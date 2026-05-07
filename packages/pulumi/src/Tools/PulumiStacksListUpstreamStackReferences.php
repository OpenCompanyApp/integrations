<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * ListUpstreamStackReferences.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/stacks/{orgName}/{projectName}/{stackName}/upstreamreferences.
 */
class PulumiStacksListUpstreamStackReferences extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_stacks_list_upstream_stack_references';
    protected const DESCRIPTION = 'ListUpstreamStackReferences

Official Pulumi Cloud endpoint: GET /api/stacks/{orgName}/{projectName}/{stackName}/upstreamreferences

Returns all stacks that the specified stack references as dependencies in its Pulumi program (via StackReference). This is useful for understanding what external stacks a given stack depends on and consumes outputs from. The response includes each referenced stack\'s organization, project, name, and version.';
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
    protected const PATH = '/api/stacks/{orgName}/{projectName}/{stackName}/upstreamreferences';
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

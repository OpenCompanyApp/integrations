<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * ListDownstreamStackReferences.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/stacks/{orgName}/{projectName}/{stackName}/downstreamreferences.
 */
class PulumiStacksListDownstreamStackReferences extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_stacks_list_downstream_stack_references';
    protected const DESCRIPTION = 'ListDownstreamStackReferences

Official Pulumi Cloud endpoint: GET /api/stacks/{orgName}/{projectName}/{stackName}/downstreamreferences

Returns all stacks that reference the specified stack as a dependency in their Pulumi programs (via StackReference). This is useful for understanding the impact of changes to a stack, as downstream stacks may consume outputs from this stack. The response includes each referencing stack\'s organization, project, name, and version.';
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
    protected const PATH = '/api/stacks/{orgName}/{projectName}/{stackName}/downstreamreferences';
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

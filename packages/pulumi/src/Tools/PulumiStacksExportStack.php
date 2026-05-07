<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * ExportStack.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/stacks/{orgName}/{projectName}/{stackName}/export.
 */
class PulumiStacksExportStack extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_stacks_export_stack';
    protected const DESCRIPTION = 'ExportStack

Official Pulumi Cloud endpoint: GET /api/stacks/{orgName}/{projectName}/{stackName}/export

Exports the current, complete state of the stack as an untyped deployment object. The response includes the deployment version, manifest (containing timestamps and plugin information), secrets providers configuration, and the full array of resources with their URNs, types, inputs, outputs, and dependency information. This endpoint is commonly used for stack state backup, migration between backends, or programmatic inspection of resource states.';
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
    protected const PATH = '/api/stacks/{orgName}/{projectName}/{stackName}/export';
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

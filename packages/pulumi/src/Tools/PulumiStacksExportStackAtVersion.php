<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * ExportStackAtVersion.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/stacks/{orgName}/{projectName}/{stackName}/export/{version}.
 */
class PulumiStacksExportStackAtVersion extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_stacks_export_stack_at_version';
    protected const DESCRIPTION = 'ExportStackAtVersion

Official Pulumi Cloud endpoint: GET /api/stacks/{orgName}/{projectName}/{stackName}/export/{version}

Exports the complete stack state at a specific historical update version, rather than the current version. This allows retrieving the deployment snapshot as it existed after a particular update completed. The response format is identical to the ExportStack endpoint. Returns 400 if the version parameter is invalid, or 404 if the specified version does not exist for this stack.';
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
);
    protected const METHOD = 'get';
    protected const PATH = '/api/stacks/{orgName}/{projectName}/{stackName}/export/{version}';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'projectName' => 'project_name',
  'stackName' => 'stack_name',
  'version' => 'version',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

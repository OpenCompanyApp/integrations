<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * GetStackUpdateSummary.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/stacks/{orgName}/{projectName}/{stackName}/updates/{version}/summary.
 */
class PulumiStacksGetStackUpdateSummary extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_stacks_get_stack_update_summary';
    protected const DESCRIPTION = 'GetStackUpdateSummary

Official Pulumi Cloud endpoint: GET /api/stacks/{orgName}/{projectName}/{stackName}/updates/{version}/summary

Returns a concise summary of a specific stack update by version number, including the update kind, result status, start and end times, and resource change counts. This is a lighter-weight alternative to GetStackUpdate when full update details are not needed. Returns 404 if the specified version does not exist.';
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
    protected const PATH = '/api/stacks/{orgName}/{projectName}/{stackName}/updates/{version}/summary';
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

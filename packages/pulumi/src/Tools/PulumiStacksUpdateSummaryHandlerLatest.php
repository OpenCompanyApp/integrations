<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * UpdateSummaryHandlerLatest.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/console/stacks/{orgName}/{projectName}/{stackName}/updates/latest/summary.
 */
class PulumiStacksUpdateSummaryHandlerLatest extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_stacks_update_summary_handler_latest';
    protected const DESCRIPTION = 'UpdateSummaryHandlerLatest

Official Pulumi Cloud endpoint: GET /api/console/stacks/{orgName}/{projectName}/{stackName}/updates/latest/summary

Returns a human-readable summary of the most recent update to the stack, without requiring a specific update ID. The summary is formatted identically to the UpdateSummary endpoint, including a tree view of resource changes. This is a convenience endpoint that automatically resolves the latest update version. Returns 404 if the stack has no updates.';
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
    protected const PATH = '/api/console/stacks/{orgName}/{projectName}/{stackName}/updates/latest/summary';
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

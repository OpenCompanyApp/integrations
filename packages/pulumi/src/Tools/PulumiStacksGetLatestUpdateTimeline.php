<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * GetLatestUpdateTimeline.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/stacks/{orgName}/{projectName}/{stackName}/updates/latest/timeline.
 */
class PulumiStacksGetLatestUpdateTimeline extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_stacks_get_latest_update_timeline';
    protected const DESCRIPTION = 'GetLatestUpdateTimeline

Official Pulumi Cloud endpoint: GET /api/stacks/{orgName}/{projectName}/{stackName}/updates/latest/timeline

Returns the timeline of all relevant events culminating with the most recent stack update. The timeline includes workflow events such as deployment triggers, previews, and the final update operation, providing a complete view of the sequence of actions that led to the current stack state. Returns 404 if no update exists.';
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
    protected const PATH = '/api/stacks/{orgName}/{projectName}/{stackName}/updates/latest/timeline';
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

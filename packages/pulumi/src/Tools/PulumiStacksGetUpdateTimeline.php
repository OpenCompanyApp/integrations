<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * GetUpdateTimeline.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/stacks/{orgName}/{projectName}/{stackName}/updates/{version}/timeline.
 */
class PulumiStacksGetUpdateTimeline extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_stacks_get_update_timeline';
    protected const DESCRIPTION = 'GetUpdateTimeline

Official Pulumi Cloud endpoint: GET /api/stacks/{orgName}/{projectName}/{stackName}/updates/{version}/timeline

Returns the timeline of all relevant events culminating with a specific stack update version. The timeline includes workflow events such as deployment triggers, previews, and the update operation itself, providing a complete view of the sequence of actions. Returns 404 if the specified update version does not exist.';
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
    protected const PATH = '/api/stacks/{orgName}/{projectName}/{stackName}/updates/{version}/timeline';
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

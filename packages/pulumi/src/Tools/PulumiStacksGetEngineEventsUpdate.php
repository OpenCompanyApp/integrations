<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * GetEngineEvents.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/stacks/{orgName}/{projectName}/{stackName}/update/{updateID}/events.
 */
class PulumiStacksGetEngineEventsUpdate extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_stacks_get_engine_events_update';
    protected const DESCRIPTION = 'GetEngineEvents

Official Pulumi Cloud endpoint: GET /api/stacks/{orgName}/{projectName}/{stackName}/update/{updateID}/events

Returns the engine events for the specified update. Engine events represent individual resource operations and diagnostic messages produced during the update. Supports pagination via continuation tokens and filtering by engine event type codes or resource URN. The include_non_activated parameter controls whether events not yet marked as activated are included.';
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
  'update_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `updateID` from the official Pulumi Cloud API operation. The update ID',
  ),
  'continuation_token' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `continuationToken` from the official Pulumi Cloud API operation. Continuation token for paginated results',
  ),
  'include_non_activated' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Query parameter `include_non_activated` from the official Pulumi Cloud API operation. When true, includes events that have not yet been activated; when false or omitted, only activated events are returned',
  ),
  'type' =>
  array (
    'type' => 'array',
    'required' => false,
    'description' => 'Query parameter `type` from the official Pulumi Cloud API operation. Filter results to only include events matching these engine event type codes',
  ),
  'urn' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `urn` from the official Pulumi Cloud API operation. Filter results to only include events for the specified resource URN',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/stacks/{orgName}/{projectName}/{stackName}/update/{updateID}/events';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'projectName' => 'project_name',
  'stackName' => 'stack_name',
  'updateID' => 'update_id',
);
    protected const QUERY_PARAMS = array (
  'continuationToken' => 'continuation_token',
  'include_non_activated' => 'include_non_activated',
  'type' => 'type',
  'urn' => 'urn',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

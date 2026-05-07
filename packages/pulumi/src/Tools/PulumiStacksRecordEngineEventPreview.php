<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * RecordEngineEvent.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/stacks/{orgName}/{projectName}/{stackName}/preview/{updateID}/events.
 */
class PulumiStacksRecordEngineEventPreview extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_stacks_record_engine_event_preview';
    protected const DESCRIPTION = 'RecordEngineEvent

Official Pulumi Cloud endpoint: POST /api/stacks/{orgName}/{projectName}/{stackName}/preview/{updateID}/events

Records a single engine event sent from the Pulumi CLI during a stack update. Engine events represent individual resource operations or diagnostic messages. For better performance, consider using RecordEngineEventBatch to send multiple events in a single request. Returns 400 if no event data is provided, or 404 if the update does not exist. Requires update token authentication.';
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
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Pulumi Cloud API request schema.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/stacks/{orgName}/{projectName}/{stackName}/preview/{updateID}/events';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'projectName' => 'project_name',
  'stackName' => 'stack_name',
  'updateID' => 'update_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

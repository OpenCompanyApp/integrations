<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * RecordEngineEventBatch.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/stacks/{orgName}/{projectName}/{stackName}/destroy/{updateID}/events/batch.
 */
class PulumiStacksRecordEngineEventBatchDestroy extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_stacks_record_engine_event_batch_destroy';
    protected const DESCRIPTION = 'RecordEngineEventBatch

Official Pulumi Cloud endpoint: POST /api/stacks/{orgName}/{projectName}/{stackName}/destroy/{updateID}/events/batch

Records a batch of engine events sent from the Pulumi CLI during a stack update. Engine events represent individual resource operations (create, update, delete, etc.) and diagnostic messages. Batching events reduces the number of API calls during an update. Returns 400 if no events are provided in the batch, or 404 if the update does not exist. Requires update token authentication.';
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
    protected const PATH = '/api/stacks/{orgName}/{projectName}/{stackName}/destroy/{updateID}/events/batch';
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

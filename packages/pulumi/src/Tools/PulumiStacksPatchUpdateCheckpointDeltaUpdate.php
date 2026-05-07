<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * PatchUpdateCheckpointDelta.
 *
 * Maps to the official Pulumi Cloud endpoint patch /api/stacks/{orgName}/{projectName}/{stackName}/update/{updateID}/checkpointdelta.
 */
class PulumiStacksPatchUpdateCheckpointDeltaUpdate extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_stacks_patch_update_checkpoint_delta_update';
    protected const DESCRIPTION = 'PatchUpdateCheckpointDelta

Official Pulumi Cloud endpoint: PATCH /api/stacks/{orgName}/{projectName}/{stackName}/update/{updateID}/checkpointdelta

Uploads a checkpoint delta for a service-managed update that is currently in progress. Rather than uploading the complete checkpoint state, this endpoint accepts an incremental delta that is applied to the existing checkpoint, reducing the payload size. The delta is persisted in the format as provided. Supports checksum validation for data integrity. Returns 403 for preview operations since previews do not modify actual state. Returns 409 if the update has not started, has been cancelled, timed out, or already completed. Requires update token authentication.';
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
    protected const METHOD = 'patch';
    protected const PATH = '/api/stacks/{orgName}/{projectName}/{stackName}/update/{updateID}/checkpointdelta';
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

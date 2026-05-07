<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * PatchUpdateVerbatimCheckpoint.
 *
 * Maps to the official Pulumi Cloud endpoint patch /api/stacks/{orgName}/{projectName}/{stackName}/update/{updateID}/checkpointverbatim.
 */
class PulumiStacksPatchUpdateVerbatimCheckpointUpdate extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_stacks_patch_update_verbatim_checkpoint_update';
    protected const DESCRIPTION = 'PatchUpdateVerbatimCheckpoint

Official Pulumi Cloud endpoint: PATCH /api/stacks/{orgName}/{projectName}/{stackName}/update/{updateID}/checkpointverbatim

Uploads a checkpoint for a service-managed update as a verbatim byte array, bypassing JSON marshalling. Unlike PatchUpdateCheckpoint which accepts a structured deployment object and re-serializes it (which may compact data), this endpoint preserves the exact bytes provided by the client and uploads them directly to blob storage. This maintains byte-level fidelity of the checkpoint data. Returns 403 for preview operations. Returns 409 if the update has not started, has been cancelled, timed out, or already completed. Requires update token authentication.';
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
    protected const PATH = '/api/stacks/{orgName}/{projectName}/{stackName}/update/{updateID}/checkpointverbatim';
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

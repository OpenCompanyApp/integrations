<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * PatchUpdateCheckpoint.
 *
 * Maps to the official Pulumi Cloud endpoint patch /api/stacks/{orgName}/{projectName}/{stackName}/update/{updateID}/checkpoint.
 */
class PulumiStacksPatchUpdateCheckpointUpdate extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_stacks_patch_update_checkpoint_update';
    protected const DESCRIPTION = 'PatchUpdateCheckpoint

Official Pulumi Cloud endpoint: PATCH /api/stacks/{orgName}/{projectName}/{stackName}/update/{updateID}/checkpoint

Uploads a new checkpoint (deployment state snapshot) for a service-managed update that is currently in progress. The checkpoint contains the complete current state of all resources. The request must contain a valid checkpoint object. Returns 403 for preview operations since previews do not modify actual state. Returns 409 if the update has not started, has been cancelled, timed out, or already completed. Requires update token authentication.';
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
    protected const PATH = '/api/stacks/{orgName}/{projectName}/{stackName}/update/{updateID}/checkpoint';
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

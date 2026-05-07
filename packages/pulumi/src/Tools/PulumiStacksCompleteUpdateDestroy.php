<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * CompleteUpdate.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/stacks/{orgName}/{projectName}/{stackName}/destroy/{updateID}/complete.
 */
class PulumiStacksCompleteUpdateDestroy extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_stacks_complete_update_destroy';
    protected const DESCRIPTION = 'CompleteUpdate

Official Pulumi Cloud endpoint: POST /api/stacks/{orgName}/{projectName}/{stackName}/destroy/{updateID}/complete

Marks a service-managed update as complete. The request body must include the final status of the update. Returns 400 if the status is unrecognized. Returns 409 if the update has not started, has been cancelled, has already timed out, or has already completed. Requires update token authentication.';
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
    protected const PATH = '/api/stacks/{orgName}/{projectName}/{stackName}/destroy/{updateID}/complete';
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

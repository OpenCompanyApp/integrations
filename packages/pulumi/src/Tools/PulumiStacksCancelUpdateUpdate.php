<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * CancelUpdate.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/stacks/{orgName}/{projectName}/{stackName}/update/{updateID}/cancel.
 */
class PulumiStacksCancelUpdateUpdate extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_stacks_cancel_update_update';
    protected const DESCRIPTION = 'CancelUpdate

Official Pulumi Cloud endpoint: POST /api/stacks/{orgName}/{projectName}/{stackName}/update/{updateID}/cancel

Requests cancellation of a service-managed update that is currently in progress. The update must have been started (returns 409 if it has not). Returns 404 if the specified update does not exist. The cancellation is processed asynchronously and the update will transition to a cancelled state.';
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
);
    protected const METHOD = 'post';
    protected const PATH = '/api/stacks/{orgName}/{projectName}/{stackName}/update/{updateID}/cancel';
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

<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * GetUpdateStatusForRefresh.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/stacks/{orgName}/{projectName}/{stackName}/refresh/{updateID}.
 */
class PulumiStacksGetUpdateStatusForRefresh extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_stacks_get_update_status_for_refresh';
    protected const DESCRIPTION = 'GetUpdateStatusForRefresh

Official Pulumi Cloud endpoint: GET /api/stacks/{orgName}/{projectName}/{stackName}/refresh/{updateID}

Returns the current status and results of a refresh update, including whether it is still in progress, succeeded, or failed. Supports pagination of results via the continuationToken query parameter.';
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
);
    protected const METHOD = 'get';
    protected const PATH = '/api/stacks/{orgName}/{projectName}/{stackName}/refresh/{updateID}';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'projectName' => 'project_name',
  'stackName' => 'stack_name',
  'updateID' => 'update_id',
);
    protected const QUERY_PARAMS = array (
  'continuationToken' => 'continuation_token',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

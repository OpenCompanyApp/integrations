<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * StartUpdateForPreview.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/stacks/{orgName}/{projectName}/{stackName}/preview/{updateID}.
 */
class PulumiStacksStartUpdateForPreview extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_stacks_start_update_for_preview';
    protected const DESCRIPTION = 'StartUpdateForPreview

Official Pulumi Cloud endpoint: POST /api/stacks/{orgName}/{projectName}/{stackName}/preview/{updateID}

Starts execution of a previously created preview update. The update must have been created via CreateUpdateForPreview first. Returns a lease token and version number for tracking the update. Returns 404 if the update does not exist, or 409 if another update is already in progress on the stack.';
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
    protected const PATH = '/api/stacks/{orgName}/{projectName}/{stackName}/preview/{updateID}';
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

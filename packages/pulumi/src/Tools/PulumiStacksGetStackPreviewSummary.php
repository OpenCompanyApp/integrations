<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * GetStackPreviewSummary.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/stacks/{orgName}/{projectName}/{stackName}/previews/{updateID}/summary.
 */
class PulumiStacksGetStackPreviewSummary extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_stacks_get_stack_preview_summary';
    protected const DESCRIPTION = 'GetStackPreviewSummary

Official Pulumi Cloud endpoint: GET /api/stacks/{orgName}/{projectName}/{stackName}/previews/{updateID}/summary

Returns a concise summary of a specific preview operation, including the update kind, result status, start and end times, and resource change counts. This is a lighter-weight alternative to GetStackPreview when full update details are not needed. Returns 404 if the specified update does not exist.';
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
    protected const METHOD = 'get';
    protected const PATH = '/api/stacks/{orgName}/{projectName}/{stackName}/previews/{updateID}/summary';
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

<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * GetStackWebhookDeliveries.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/stacks/{orgName}/{projectName}/{stackName}/hooks/{hookName}/deliveries.
 */
class PulumiStacksGetStackWebhookDeliveries extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_stacks_get_stack_webhook_deliveries';
    protected const DESCRIPTION = 'GetStackWebhookDeliveries

Official Pulumi Cloud endpoint: GET /api/stacks/{orgName}/{projectName}/{stackName}/hooks/{hookName}/deliveries

Returns the recent delivery history for a specific webhook. Each delivery includes the timestamp, HTTP status code, request and response details, and whether the delivery was successful.';
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
  'hook_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `hookName` from the official Pulumi Cloud API operation. The webhook name',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/stacks/{orgName}/{projectName}/{stackName}/hooks/{hookName}/deliveries';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'projectName' => 'project_name',
  'stackName' => 'stack_name',
  'hookName' => 'hook_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

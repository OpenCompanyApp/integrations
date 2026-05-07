<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * PingStackWebhook.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/stacks/{orgName}/{projectName}/{stackName}/hooks/{hookName}/ping.
 */
class PulumiStacksPingStackWebhook extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_stacks_ping_stack_webhook';
    protected const DESCRIPTION = 'PingStackWebhook

Official Pulumi Cloud endpoint: POST /api/stacks/{orgName}/{projectName}/{stackName}/hooks/{hookName}/ping

Issues a test ping event to the specified webhook to verify it is properly configured and reachable. Unlike normal webhook deliveries, this bypasses the message queue and sends the request directly to the webhook endpoint. The response includes the delivery result with HTTP status and response details. Returns 404 if the webhook does not exist.';
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
    protected const METHOD = 'post';
    protected const PATH = '/api/stacks/{orgName}/{projectName}/{stackName}/hooks/{hookName}/ping';
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

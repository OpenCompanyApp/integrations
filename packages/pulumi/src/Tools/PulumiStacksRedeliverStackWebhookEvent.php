<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * RedeliverStackWebhookEvent.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/stacks/{orgName}/{projectName}/{stackName}/hooks/{hookName}/deliveries/{event}/redeliver.
 */
class PulumiStacksRedeliverStackWebhookEvent extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_stacks_redeliver_stack_webhook_event';
    protected const DESCRIPTION = 'RedeliverStackWebhookEvent

Official Pulumi Cloud endpoint: POST /api/stacks/{orgName}/{projectName}/{stackName}/hooks/{hookName}/deliveries/{event}/redeliver

Triggers the Pulumi Service to redeliver a specific event to a webhook. This is useful for resending an event that the webhook endpoint failed to process on the initial delivery attempt. Returns the delivery result with HTTP status and response details. Returns 404 if the webhook or event does not exist.';
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
  'event' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `event` from the official Pulumi Cloud API operation. The webhook delivery event identifier to redeliver',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/stacks/{orgName}/{projectName}/{stackName}/hooks/{hookName}/deliveries/{event}/redeliver';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'projectName' => 'project_name',
  'stackName' => 'stack_name',
  'hookName' => 'hook_name',
  'event' => 'event',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * PingWebhook.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/preview/environments/{orgName}/{envName}/hooks/{hookName}/ping.
 */
class PulumiEnvironmentsPingWebhookPreviewEnvironments extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_environments_ping_webhook_preview_environments';
    protected const DESCRIPTION = 'PingWebhook

Official Pulumi Cloud endpoint: POST /api/preview/environments/{orgName}/{envName}/hooks/{hookName}/ping

Sends a test ping event to a webhook on a Pulumi ESC environment to verify that the webhook endpoint is reachable and functioning correctly. This bypasses the normal message queue and issues the request directly to the webhook URL. Returns the WebhookDelivery record containing the HTTP status code and response from the target endpoint.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
  'env_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `envName` from the official Pulumi Cloud API operation. The environment name',
  ),
  'hook_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `hookName` from the official Pulumi Cloud API operation. The webhook name',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/preview/environments/{orgName}/{envName}/hooks/{hookName}/ping';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'envName' => 'env_name',
  'hookName' => 'hook_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

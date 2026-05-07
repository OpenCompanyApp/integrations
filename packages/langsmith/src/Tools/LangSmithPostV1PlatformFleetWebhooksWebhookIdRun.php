<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Run a fleet webhook.
 *
 * Maps to the official LangSmith endpoint POST /v1/platform/fleet-webhooks/{webhook_id}/run.
 */
class LangSmithPostV1PlatformFleetWebhooksWebhookIdRun extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_post_v1_platform_fleet_webhooks_webhook_id_run';
    protected const DESCRIPTION = 'Run a fleet webhook

Official endpoint: POST /v1/platform/fleet-webhooks/{webhook_id}/run
Sends the request payload to the webhook\'s stored URL and returns the upstream response in a JSON envelope.';
    protected const PARAMETERS = array (
  'webhook_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `webhook_id`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/platform/fleet-webhooks/{webhook_id}/run';
    protected const PATH_PARAMS = array (
  0 => 'webhook_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}

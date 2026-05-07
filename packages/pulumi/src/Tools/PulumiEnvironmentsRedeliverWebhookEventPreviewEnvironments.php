<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * RedeliverWebhookEvent.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/preview/environments/{orgName}/{envName}/hooks/{hookName}/deliveries/{event}/redeliver.
 */
class PulumiEnvironmentsRedeliverWebhookEventPreviewEnvironments extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_environments_redeliver_webhook_event_preview_environments';
    protected const DESCRIPTION = 'RedeliverWebhookEvent

Official Pulumi Cloud endpoint: POST /api/preview/environments/{orgName}/{envName}/hooks/{hookName}/deliveries/{event}/redeliver

Triggers the Pulumi Service to redeliver a specific event to a webhook on a Pulumi ESC environment. This is useful for resending events that the webhook endpoint failed to process on the initial delivery attempt (e.g., due to temporary downtime or errors). The event is identified by its delivery event ID in the URL path. Returns the new WebhookDelivery record for the redelivery.';
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
  'event' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `event` from the official Pulumi Cloud API operation. The webhook delivery event ID to redeliver',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/preview/environments/{orgName}/{envName}/hooks/{hookName}/deliveries/{event}/redeliver';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'envName' => 'env_name',
  'hookName' => 'hook_name',
  'event' => 'event',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

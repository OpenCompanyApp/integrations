<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Verify a webhook subscription.
 *
 * Maps to the official Ramp endpoint post /developer/v1/webhooks/{webhook_id}/verify.
 */
class RampPostOutboundWebhookSubscriptionVerifyResource extends AbstractRampTool
{
    protected const NAME = 'ramp_post_outbound_webhook_subscription_verify_resource';
    protected const DESCRIPTION = 'Verify a webhook subscription

Official Ramp endpoint: POST /developer/v1/webhooks/{webhook_id}/verify';
    protected const PARAMETERS = array (
  'webhook_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `webhook_id` from the official Ramp API operation.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Ramp OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/developer/v1/webhooks/{webhook_id}/verify';
    protected const PATH_PARAMS = array (
  'webhook_id' => 'webhook_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}

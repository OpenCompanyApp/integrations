<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Creates a new webhook subscription.
 *
 * Maps to the official Ramp endpoint post /developer/v1/webhooks.
 */
class RampPostOutboundWebhookSubscriptionResource extends AbstractRampTool
{
    protected const NAME = 'ramp_post_outbound_webhook_subscription_resource';
    protected const DESCRIPTION = 'Creates a new webhook subscription

Official Ramp endpoint: POST /developer/v1/webhooks

The newly registered subscription will be in the pending verficiation state. You will need to verify your endpoint with the provided challenge.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Ramp OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/developer/v1/webhooks';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}

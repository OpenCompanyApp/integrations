<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Create a mock webhook event for active subscriptions matching the event type.
 *
 * Maps to the official Ramp endpoint post /developer/v1/webhooks/mock-webhook-event.
 */
class RampPostMockOutboundWebhookEventResource extends AbstractRampTool
{
    protected const NAME = 'ramp_post_mock_outbound_webhook_event_resource';
    protected const DESCRIPTION = 'Create a mock webhook event for active subscriptions matching the event type

Official Ramp endpoint: POST /developer/v1/webhooks/mock-webhook-event';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Ramp OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/developer/v1/webhooks/mock-webhook-event';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}

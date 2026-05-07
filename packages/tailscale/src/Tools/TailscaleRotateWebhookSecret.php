<?php

namespace OpenCompany\Integrations\Tailscale\Tools;

/**
 * Rotate webhook secret.
 *
 * Maps to the official Tailscale endpoint post /webhooks/{endpointId}/rotate.
 */
class TailscaleRotateWebhookSecret extends AbstractTailscaleTool
{
    protected const NAME = 'tailscale_rotate_webhook_secret';
    protected const DESCRIPTION = 'Rotate webhook secret

Official Tailscale endpoint: POST /webhooks/{endpointId}/rotate

Rotate and generate a new secret for a specific webhook.

This secret is used for generating the `Tailscale-Webhook-Signature` header in requests sent to the endpoint URL.
Learn more about [verifying webhook event signatures](/kb/1213/webhooks#verifying-an-event-signature).

OAuth Scope: `webhooks`.';
    protected const PARAMETERS = array (
  'endpoint_id' =>
  array (
    'type' => 'string',
    'description' => 'ID for the webhook endpoint.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/webhooks/{endpointId}/rotate';
    protected const PATH_PARAMS = array (
  'endpointId' => 'endpoint_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

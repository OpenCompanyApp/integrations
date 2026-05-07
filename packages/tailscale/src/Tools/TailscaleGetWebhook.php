<?php

namespace OpenCompany\Integrations\Tailscale\Tools;

/**
 * Get webhook.
 *
 * Maps to the official Tailscale endpoint get /webhooks/{endpointId}.
 */
class TailscaleGetWebhook extends AbstractTailscaleTool
{
    protected const NAME = 'tailscale_get_webhook';
    protected const DESCRIPTION = 'Get webhook

Official Tailscale endpoint: GET /webhooks/{endpointId}

Retrieve a specific webhook.

OAuth Scope: `webhooks:read`.';
    protected const PARAMETERS = array (
  'endpoint_id' =>
  array (
    'type' => 'string',
    'description' => 'ID for the webhook endpoint.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/webhooks/{endpointId}';
    protected const PATH_PARAMS = array (
  'endpointId' => 'endpoint_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

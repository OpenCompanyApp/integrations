<?php

namespace OpenCompany\Integrations\Tailscale\Tools;

/**
 * Update webhook.
 *
 * Maps to the official Tailscale endpoint patch /webhooks/{endpointId}.
 */
class TailscaleUpdateWebhook extends AbstractTailscaleTool
{
    protected const NAME = 'tailscale_update_webhook';
    protected const DESCRIPTION = 'Update webhook

Official Tailscale endpoint: PATCH /webhooks/{endpointId}

Update a specific webhook.

OAuth Scope: `webhooks`.';
    protected const PARAMETERS = array (
  'endpoint_id' =>
  array (
    'type' => 'string',
    'description' => 'ID for the webhook endpoint.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the Tailscale API schema.',
  ),
);
    protected const METHOD = 'patch';
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

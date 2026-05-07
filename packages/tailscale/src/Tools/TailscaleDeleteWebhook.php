<?php

namespace OpenCompany\Integrations\Tailscale\Tools;

/**
 * Delete webhook.
 *
 * Maps to the official Tailscale endpoint delete /webhooks/{endpointId}.
 */
class TailscaleDeleteWebhook extends AbstractTailscaleTool
{
    protected const NAME = 'tailscale_delete_webhook';
    protected const DESCRIPTION = 'Delete webhook

Official Tailscale endpoint: DELETE /webhooks/{endpointId}

Delete a specific webhook.

OAuth Scope: `webhooks`.';
    protected const PARAMETERS = array (
  'endpoint_id' =>
  array (
    'type' => 'string',
    'description' => 'ID for the webhook endpoint.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
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

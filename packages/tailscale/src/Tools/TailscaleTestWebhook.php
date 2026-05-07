<?php

namespace OpenCompany\Integrations\Tailscale\Tools;

/**
 * Test a webhook.
 *
 * Maps to the official Tailscale endpoint post /webhooks/{endpointId}/test.
 */
class TailscaleTestWebhook extends AbstractTailscaleTool
{
    protected const NAME = 'tailscale_test_webhook';
    protected const DESCRIPTION = 'Test a webhook

Official Tailscale endpoint: POST /webhooks/{endpointId}/test

Test a specific webhook by sending out a test event to the endpoint URL.
This endpoint queues the event which is sent out asynchronously.

If your webhook is configured correctly, within a few seconds your webhook endpoint should receive an event with type of "test".

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
    protected const PATH = '/webhooks/{endpointId}/test';
    protected const PATH_PARAMS = array (
  'endpointId' => 'endpoint_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

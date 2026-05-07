<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Manually fire a Transfer webhook.
 *
 * Maps to the official Plaid endpoint post /sandbox/transfer/fire_webhook.
 */
class PlaidSandboxTransferFireWebhook extends AbstractPlaidTool
{
    protected const NAME = 'plaid_sandbox_transfer_fire_webhook';
    protected const DESCRIPTION = 'Manually fire a Transfer webhook

Official Plaid endpoint: POST /sandbox/transfer/fire_webhook

Use the `/sandbox/transfer/fire_webhook` endpoint to manually trigger a `TRANSFER_EVENTS_UPDATE` webhook in the Sandbox environment.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/sandbox/transfer/fire_webhook';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
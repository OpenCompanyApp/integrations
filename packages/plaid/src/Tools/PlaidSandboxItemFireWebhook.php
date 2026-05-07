<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Fire a test webhook.
 *
 * Maps to the official Plaid endpoint post /sandbox/item/fire_webhook.
 */
class PlaidSandboxItemFireWebhook extends AbstractPlaidTool
{
    protected const NAME = 'plaid_sandbox_item_fire_webhook';
    protected const DESCRIPTION = 'Fire a test webhook

Official Plaid endpoint: POST /sandbox/item/fire_webhook

The `/sandbox/item/fire_webhook` endpoint is used to test that code correctly handles webhooks. This endpoint can trigger the following webhooks: `DEFAULT_UPDATE`: Webhook to be fired for a given Sandbox Item simulating a default update event for the respective product as specified with the `webhook_type` in the request body. Valid Sandbox `DEFAULT_UPDATE` webhook types include: `AUTH`, `IDENTITY`, `TRANSACTIONS`, `INVESTMENTS_TRANSACTIONS`, `LIABILITIES`, `HOLDINGS`. If the Item does not support the product, a `SANDBOX_PRODUCT_NOT_ENABLED` error will result. `NEW_ACCOUNTS_AVAILABLE`: Fired to indicate that a new account is available on the Item and you can launch update mode to request a...';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/sandbox/item/fire_webhook';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
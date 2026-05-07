<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Update Webhook URL.
 *
 * Maps to the official Plaid endpoint post /item/webhook/update.
 */
class PlaidItemWebhookUpdate extends AbstractPlaidTool
{
    protected const NAME = 'plaid_item_webhook_update';
    protected const DESCRIPTION = 'Update Webhook URL

Official Plaid endpoint: POST /item/webhook/update

The POST `/item/webhook/update` allows you to update the webhook URL associated with an Item. This request triggers a [`WEBHOOK_UPDATE_ACKNOWLEDGED`](https://plaid.com/docs/api/items/#webhook_update_acknowledged) webhook to the newly specified webhook URL.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/item/webhook/update';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
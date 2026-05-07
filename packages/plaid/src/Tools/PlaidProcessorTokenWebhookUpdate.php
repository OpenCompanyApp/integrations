<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Update a processor token's webhook URL.
 *
 * Maps to the official Plaid endpoint post /processor/token/webhook/update.
 */
class PlaidProcessorTokenWebhookUpdate extends AbstractPlaidTool
{
    protected const NAME = 'plaid_processor_token_webhook_update';
    protected const DESCRIPTION = 'Update a processor token\'s webhook URL

Official Plaid endpoint: POST /processor/token/webhook/update

This endpoint allows you, the processor, to update the webhook URL associated with a processor token. This request triggers a `WEBHOOK_UPDATE_ACKNOWLEDGED` webhook to the newly specified webhook URL.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/processor/token/webhook/update';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
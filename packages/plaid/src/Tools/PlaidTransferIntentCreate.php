<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Create a transfer intent object to invoke the Transfer UI.
 *
 * Maps to the official Plaid endpoint post /transfer/intent/create.
 */
class PlaidTransferIntentCreate extends AbstractPlaidTool
{
    protected const NAME = 'plaid_transfer_intent_create';
    protected const DESCRIPTION = 'Create a transfer intent object to invoke the Transfer UI

Official Plaid endpoint: POST /transfer/intent/create

Use the `/transfer/intent/create` endpoint to generate a transfer intent object and invoke the Transfer UI.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/transfer/intent/create';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Retrieve more information about a transfer intent.
 *
 * Maps to the official Plaid endpoint post /transfer/intent/get.
 */
class PlaidTransferIntentGet extends AbstractPlaidTool
{
    protected const NAME = 'plaid_transfer_intent_get';
    protected const DESCRIPTION = 'Retrieve more information about a transfer intent

Official Plaid endpoint: POST /transfer/intent/get

Use the `/transfer/intent/get` endpoint to retrieve more information about a transfer intent.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/transfer/intent/get';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
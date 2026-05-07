<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * (Deprecated) Retrieve a balance held with Plaid.
 *
 * Maps to the official Plaid endpoint post /transfer/balance/get.
 */
class PlaidTransferBalanceGet extends AbstractPlaidTool
{
    protected const NAME = 'plaid_transfer_balance_get';
    protected const DESCRIPTION = '(Deprecated) Retrieve a balance held with Plaid

Official Plaid endpoint: POST /transfer/balance/get

(Deprecated) Use the `/transfer/balance/get` endpoint to view a balance held with Plaid.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/transfer/balance/get';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Fetch an e-wallet.
 *
 * Maps to the official Plaid endpoint post /wallet/get.
 */
class PlaidWalletGet extends AbstractPlaidTool
{
    protected const NAME = 'plaid_wallet_get';
    protected const DESCRIPTION = 'Fetch an e-wallet

Official Plaid endpoint: POST /wallet/get

Fetch an e-wallet. The response includes the current balance.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/wallet/get';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
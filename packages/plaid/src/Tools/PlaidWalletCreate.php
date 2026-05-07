<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Create an e-wallet.
 *
 * Maps to the official Plaid endpoint post /wallet/create.
 */
class PlaidWalletCreate extends AbstractPlaidTool
{
    protected const NAME = 'plaid_wallet_create';
    protected const DESCRIPTION = 'Create an e-wallet

Official Plaid endpoint: POST /wallet/create

Create an e-wallet. The response is the newly created e-wallet object.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/wallet/create';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
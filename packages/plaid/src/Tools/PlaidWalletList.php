<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Fetch a list of e-wallets.
 *
 * Maps to the official Plaid endpoint post /wallet/list.
 */
class PlaidWalletList extends AbstractPlaidTool
{
    protected const NAME = 'plaid_wallet_list';
    protected const DESCRIPTION = 'Fetch a list of e-wallets

Official Plaid endpoint: POST /wallet/list

This endpoint lists all e-wallets in descending order of creation.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/wallet/list';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
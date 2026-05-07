<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Retrieve accounts.
 *
 * Maps to the official Plaid endpoint post /accounts/get.
 */
class PlaidAccountsGet extends AbstractPlaidTool
{
    protected const NAME = 'plaid_accounts_get';
    protected const DESCRIPTION = 'Retrieve accounts

Official Plaid endpoint: POST /accounts/get

The `/accounts/get` endpoint can be used to retrieve a list of accounts associated with any linked Item. Plaid will only return active bank accounts — that is, accounts that are not closed and are capable of carrying a balance. To return new accounts that were created after the user linked their Item, you can listen for the [`NEW_ACCOUNTS_AVAILABLE`](https://plaid.com/docs/api/items/#new_accounts_available) webhook and then use Link\'s [update mode](https://plaid.com/docs/link/update-mode/) to request that the user share this new account with you. `/accounts/get` is free to use and retrieves cached information, rather than extracting fresh information from the institution. The balance re...';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/accounts/get';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
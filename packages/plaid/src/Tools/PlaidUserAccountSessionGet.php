<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Retrieve User Account.
 *
 * Maps to the official Plaid endpoint post /user_account/session/get.
 */
class PlaidUserAccountSessionGet extends AbstractPlaidTool
{
    protected const NAME = 'plaid_user_account_session_get';
    protected const DESCRIPTION = 'Retrieve User Account

Official Plaid endpoint: POST /user_account/session/get

This endpoint returns user permissioned account data, including identity and Item access tokens, for use with [Plaid Layer](https://plaid.com/docs/layer). Note that end users are permitted to edit the prefilled identity data in the Link flow before sharing it with you; you should treat any identity data returned by this endpoint as user-submitted, unverified data. For a verification layer, you can add [Identity Verification](https://plaid.com/docs/identity-verification/) to your flow, or check the submitted identity data against bank account data from linked accounts using [Identity Match](https://plaid.com/docs/identity/#identity-match).';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/user_account/session/get';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
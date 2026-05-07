<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Exchange public token for an access token.
 *
 * Maps to the official Plaid endpoint post /item/public_token/exchange.
 */
class PlaidItemPublicTokenExchange extends AbstractPlaidTool
{
    protected const NAME = 'plaid_item_public_token_exchange';
    protected const DESCRIPTION = 'Exchange public token for an access token

Official Plaid endpoint: POST /item/public_token/exchange

Exchange a Link `public_token` for an API `access_token`. Link hands off the `public_token` client-side via the `onSuccess` callback once a user has successfully created an Item. The `public_token` is ephemeral and expires after 30 minutes. An `access_token` does not expire, but can be revoked by calling `/item/remove`. The response also includes an `item_id` that should be stored with the `access_token`. The `item_id` is used to identify an Item in a webhook. The `item_id` can also be retrieved by making an `/item/get` request.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/item/public_token/exchange';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
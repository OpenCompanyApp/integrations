<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Create public token.
 *
 * Maps to the official Plaid endpoint post /item/public_token/create.
 */
class PlaidItemCreatePublicToken extends AbstractPlaidTool
{
    protected const NAME = 'plaid_item_create_public_token';
    protected const DESCRIPTION = 'Create public token

Official Plaid endpoint: POST /item/public_token/create

Note: As of July 2020, the `/item/public_token/create` endpoint is deprecated. Instead, use `/link/token/create` with an `access_token` to create a Link token for use with [update mode](https://plaid.com/docs/link/update-mode). If you need your user to take action to restore or resolve an error associated with an Item, generate a public token with the `/item/public_token/create` endpoint and then initialize Link with that `public_token`. A `public_token` is one-time use and expires after 30 minutes. You use a `public_token` to initialize Link in [update mode](https://plaid.com/docs/link/update-mode) for a particular Item. You can generate a `public_token` for an Item even if you did not u...';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/item/public_token/create';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
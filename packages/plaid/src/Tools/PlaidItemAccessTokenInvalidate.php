<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Invalidate access_token.
 *
 * Maps to the official Plaid endpoint post /item/access_token/invalidate.
 */
class PlaidItemAccessTokenInvalidate extends AbstractPlaidTool
{
    protected const NAME = 'plaid_item_access_token_invalidate';
    protected const DESCRIPTION = 'Invalidate access_token

Official Plaid endpoint: POST /item/access_token/invalidate

By default, the `access_token` associated with an Item does not expire and should be stored in a persistent, secure manner. You can use the `/item/access_token/invalidate` endpoint to rotate the `access_token` associated with an Item. The endpoint returns a new `access_token` and immediately invalidates the previous `access_token`.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/item/access_token/invalidate';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Get Link Token.
 *
 * Maps to the official Plaid endpoint post /link/token/get.
 */
class PlaidLinkTokenGet extends AbstractPlaidTool
{
    protected const NAME = 'plaid_link_token_get';
    protected const DESCRIPTION = 'Get Link Token

Official Plaid endpoint: POST /link/token/get

The `/link/token/get` endpoint gets information about a Link session, including all callbacks fired during the session along with their metadata, including the public token. This endpoint is used with Link flows that don\'t provide a public token via frontend callbacks, such as the [Hosted Link flow](https://plaid.com/docs/link/hosted-link/) and the [Multi-Item Link flow](https://plaid.com/docs/link/multi-item-link/). It also can be useful for debugging purposes. By default, this endpoint will only return complete event data for Hosted Link sessions. To use `/link/token/get` to retrieve event data for non-Hosted-Link sessions, contact your account manager to request that your account be en...';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/link/token/get';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
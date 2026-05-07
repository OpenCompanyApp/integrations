<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Create or refresh an OAuth access token.
 *
 * Maps to the official Plaid endpoint post /oauth/token.
 */
class PlaidOauthToken extends AbstractPlaidTool
{
    protected const NAME = 'plaid_oauth_token';
    protected const DESCRIPTION = 'Create or refresh an OAuth access token

Official Plaid endpoint: POST /oauth/token

`/oauth/token` issues an access token and refresh token depending on the `grant_type` provided. This endpoint supports `Content-Type: application/x-www-form-urlencoded` as well as JSON. The fields for the form are equivalent to the fields for JSON and conform to the OAuth 2.0 specification.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/oauth/token';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
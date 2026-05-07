<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Get metadata about an OAuth token.
 *
 * Maps to the official Plaid endpoint post /oauth/introspect.
 */
class PlaidOauthIntrospect extends AbstractPlaidTool
{
    protected const NAME = 'plaid_oauth_introspect';
    protected const DESCRIPTION = 'Get metadata about an OAuth token

Official Plaid endpoint: POST /oauth/introspect

`/oauth/introspect` returns metadata about an access token or refresh token. Note: This endpoint supports `Content-Type: application/x-www-form-urlencoded` as well as JSON. The fields for the form are equivalent to the fields for JSON and conform to the OAuth 2.0 specification.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/oauth/introspect';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
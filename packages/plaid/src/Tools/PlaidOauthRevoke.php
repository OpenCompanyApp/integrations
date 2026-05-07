<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Revoke an OAuth token.
 *
 * Maps to the official Plaid endpoint post /oauth/revoke.
 */
class PlaidOauthRevoke extends AbstractPlaidTool
{
    protected const NAME = 'plaid_oauth_revoke';
    protected const DESCRIPTION = 'Revoke an OAuth token

Official Plaid endpoint: POST /oauth/revoke

`/oauth/revoke` revokes an access or refresh token, preventing any further use. If a refresh token is revoked, all access and refresh tokens derived from it are also revoked, including exchanged tokens. Note: This endpoint supports `Content-Type: application/x-www-form-urlencoded` as well as JSON. The fields for the form are equivalent to the fields for JSON and conform to the OAuth 2.0 specification.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/oauth/revoke';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
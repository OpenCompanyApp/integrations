<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Create a token.
 *
 * Maps to the official Ramp endpoint post /developer/v1/token.
 */
class RampPostToken extends AbstractRampTool
{
    protected const NAME = 'ramp_post_token';
    protected const DESCRIPTION = 'Create a token

Official Ramp endpoint: POST /developer/v1/token

Expects two headers: - Authorization header formed from base-64 encoded client credentials as `Authorization: Basic ` - `Content-Type: application/x-www-form-urlencoded` Required content body depends on authorization type method, as defined by `grant_type`. - Authorization Code Grant (`grant_type=authorization_code`): `grant_type`, `code`, and `redirect_uri` are required. Request must happen after requested scopes have been approved and exchanged for authorization code. - Refresh Token Grant (`grant_type=refresh_token`): `grant_type` and `refresh_token` are required. User must have previously obtained refresh token in authorization code flow. - Client Credentials Grant (`grant_type=client...';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Ramp OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/developer/v1/token';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}

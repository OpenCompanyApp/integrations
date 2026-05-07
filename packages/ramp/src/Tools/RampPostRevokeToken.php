<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Revoke an access or refresh token.
 *
 * Maps to the official Ramp endpoint post /developer/v1/token/revoke.
 */
class RampPostRevokeToken extends AbstractRampTool
{
    protected const NAME = 'ramp_post_revoke_token';
    protected const DESCRIPTION = 'Revoke an access or refresh token

Official Ramp endpoint: POST /developer/v1/token/revoke

Expects an authorization header formed from base-64 encoded client credentials as `Authorization: Basic `. Content body must be form-encoded. Example: ``` curl \\ -X POST \\ -H "Authorization: Basic " \\ -H "Content-Type: application/x-www-form-urlencoded" \\ --data-urlencode \'token=$RAMP_API_TOKEN\' \\ \'https://api.ramp.com/developer/v1/token/revoke\' ```';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Ramp OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/developer/v1/token/revoke';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}

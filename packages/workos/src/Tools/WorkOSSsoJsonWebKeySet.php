<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Get JWKS.
 *
 * Maps to the official WorkOS endpoint get /sso/jwks/{clientId}.
 */
class WorkOSSsoJsonWebKeySet extends AbstractWorkOSTool
{
    protected const NAME = 'workos_sso_json_web_key_set';
    protected const DESCRIPTION = 'Get JWKS

Official WorkOS endpoint: GET /sso/jwks/{clientId}

Returns the JSON Web Key Set (JWKS) containing the public keys used for verifying access tokens.';
    protected const PARAMETERS = array (
  'client_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `clientId` from the official WorkOS API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/sso/jwks/{clientId}';
    protected const PATH_PARAMS = array (
  'clientId' => 'client_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

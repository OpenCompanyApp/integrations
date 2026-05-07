<?php

namespace OpenCompany\Integrations\Dwolla\Tools;

/**
 * Create an application access token.
 *
 * Maps to the official Dwolla endpoint POST /token.
 */
class DwollaCreateApplicationAccessToken extends AbstractDwollaTool
{
    protected const NAME = 'dwolla_create_application_access_token';
    protected const DESCRIPTION = 'Generate an application access token using OAuth 2.0 client credentials flow for server-to-server authentication. Requires client ID and secret sent via Basic authentication header with grant_type=client_credentials in the request body. Returns a bearer access token with expiration time for authenticating API requests scoped to your application. Essential for secure API access.

Official Dwolla endpoint: POST /token.';
    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official Dwolla OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/token';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/x-www-form-urlencoded';
    protected const AUTH_MODE = 'basic';
}

<?php

namespace OpenCompany\Integrations\Dwolla\Tools;

/**
 * Create a client token.
 *
 * Maps to the official Dwolla endpoint POST /client-tokens.
 */
class DwollaCreateClientToken extends AbstractDwollaTool
{
    protected const NAME = 'dwolla_create_client_token';
    protected const DESCRIPTION = 'Create a client token

Official Dwolla endpoint: POST /client-tokens.';
    protected const PARAMETERS = [
        'accept' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
            'enum' => ['application/vnd.dwolla.v1.hal+json'],
        ],
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official Dwolla OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/client-tokens';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [
        'Accept' => 'accept',
    ];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}

<?php

namespace OpenCompany\Integrations\Greenhouse\Tools;

/**
 * generate access_token.
 *
 * Maps to the official Greenhouse Harvest v3 endpoint POST /auth/token.
 */
class GreenhousePostAuthToken extends AbstractGreenhouseTool
{
    protected const NAME = 'greenhouse_post_auth_token';
    protected const DESCRIPTION = 'generate access_token

Official Greenhouse Harvest v3 endpoint: POST /auth/token.';
    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'JSON request body matching the official Greenhouse Harvest v3 schema for this operation.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/auth/token';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const AUTH_MODE = 'client_credentials_request';
}

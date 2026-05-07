<?php

namespace OpenCompany\Integrations\Dwolla\Tools;

/**
 * Create re-authentication exchange session.
 *
 * Maps to the official Dwolla endpoint POST /exchanges/{id}/exchange-sessions.
 */
class DwollaCreateReAuthExchangeSession extends AbstractDwollaTool
{
    protected const NAME = 'dwolla_create_re_auth_exchange_session';
    protected const DESCRIPTION = 'Creates a re-authentication exchange session to refresh a user\'s bank account connection when their existing authorization is no longer valid. Required when receiving an UpdateCredentials error during bank balance checks or when user re-authentication is needed.

Official Dwolla endpoint: POST /exchanges/{id}/exchange-sessions.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Exchange\'s unique identifier',
        ],
        'accept' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
            'enum' => ['application/vnd.dwolla.v1.hal+json'],
        ],
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'Request body matching the official Dwolla OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/exchanges/{id}/exchange-sessions';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [
        'Accept' => 'accept',
    ];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/vnd.dwolla.v1.hal+json';
    protected const AUTH_MODE = 'bearer';
}

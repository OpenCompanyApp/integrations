<?php

namespace OpenCompany\Integrations\Dwolla\Tools;

/**
 * Create an exchange for an account.
 *
 * Maps to the official Dwolla endpoint POST /exchanges.
 */
class DwollaCreateAccountExchange extends AbstractDwollaTool
{
    protected const NAME = 'dwolla_create_account_exchange';
    protected const DESCRIPTION = 'Create an exchange for an account. The request body will vary based on the exchange partner. For Finicity, the request body will include finicity-specific fields. For MX Secure Exchange, the request body will include a token. For Flinks Secure Exchange, the request body will include a token. For Plaid Secure Exchange, the request body will include a token.

Official Dwolla endpoint: POST /exchanges.';
    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official Dwolla OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/exchanges';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}

<?php

namespace OpenCompany\Integrations\Dwolla\Tools;

/**
 * List exchanges for an account.
 *
 * Maps to the official Dwolla endpoint GET /exchanges.
 */
class DwollaListAccountExchanges extends AbstractDwollaTool
{
    protected const NAME = 'dwolla_list_account_exchanges';
    protected const DESCRIPTION = 'Returns all exchanges for your Dwolla account. Exchanges represent connections between external bank accounts and your account through open banking partners. Includes exchange status, creation date, and associated partner information.

Official Dwolla endpoint: GET /exchanges.';
    protected const PARAMETERS = [
        'accept' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
            'enum' => ['application/vnd.dwolla.v1.hal+json'],
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/exchanges';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [
        'Accept' => 'accept',
    ];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}

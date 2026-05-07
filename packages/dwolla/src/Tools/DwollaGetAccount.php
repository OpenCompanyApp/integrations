<?php

namespace OpenCompany\Integrations\Dwolla\Tools;

/**
 * Retrieve account details.
 *
 * Maps to the official Dwolla endpoint GET /accounts/{id}.
 */
class DwollaGetAccount extends AbstractDwollaTool
{
    protected const NAME = 'dwolla_get_account';
    protected const DESCRIPTION = 'Returns basic account information for your authorized Main Dwolla Account, including account ID, name, and links to related resources such as funding sources, transfers, and customers.

Official Dwolla endpoint: GET /accounts/{id}.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Account\'s unique identifier',
        ],
        'accept' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
            'enum' => ['application/vnd.dwolla.v1.hal+json'],
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/accounts/{id}';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [
        'Accept' => 'accept',
    ];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}

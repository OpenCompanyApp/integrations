<?php

namespace OpenCompany\Integrations\Dwolla\Tools;

/**
 * List funding sources for an account.
 *
 * Maps to the official Dwolla endpoint GET /accounts/{id}/funding-sources.
 */
class DwollaListFundingSources extends AbstractDwollaTool
{
    protected const NAME = 'dwolla_list_funding_sources';
    protected const DESCRIPTION = 'Get a list of all funding sources associated with a specific Main Dwolla Account. This endpoint returns both bank accounts and balance funding sources, with detailed information about each funding source\'s status, type, and available processing channels.

Official Dwolla endpoint: GET /accounts/{id}/funding-sources.';
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
        'removed' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Filter removed funding sources. Boolean value. Defaults to `true`',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/accounts/{id}/funding-sources';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [
        'removed' => 'removed',
    ];
    protected const HEADER_PARAMS = [
        'Accept' => 'accept',
    ];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}

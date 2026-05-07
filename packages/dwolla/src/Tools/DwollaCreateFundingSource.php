<?php

namespace OpenCompany\Integrations\Dwolla\Tools;

/**
 * Create a funding source for an account.
 *
 * Maps to the official Dwolla endpoint POST /funding-sources.
 */
class DwollaCreateFundingSource extends AbstractDwollaTool
{
    protected const NAME = 'dwolla_create_funding_source';
    protected const DESCRIPTION = 'Create a funding source by adding a bank account to a Main Dwolla Account. This endpoint allows you to connect a checking or savings account using either manual bank account details or an exchange resource. For more information about funding sources, see the [Funding Sources API Reference](https://developers.dwolla.com/docs/api-reference/funding-sources).

Official Dwolla endpoint: POST /funding-sources.';
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
    protected const PATH = '/funding-sources';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [
        'Accept' => 'accept',
    ];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}

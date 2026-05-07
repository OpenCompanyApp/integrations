<?php

namespace OpenCompany\Integrations\Dwolla\Tools;

/**
 * List exchange partners.
 *
 * Maps to the official Dwolla endpoint GET /exchange-partners.
 */
class DwollaListExchangePartners extends AbstractDwollaTool
{
    protected const NAME = 'dwolla_list_exchange_partners';
    protected const DESCRIPTION = 'Returns a list of all supported exchange partners. Each partner includes a unique ID, name, and status indicating whether they are active or inactive.

Official Dwolla endpoint: GET /exchange-partners.';
    protected const PARAMETERS = [
        'accept' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
            'enum' => ['application/vnd.dwolla.v1.hal+json'],
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/exchange-partners';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [
        'Accept' => 'accept',
    ];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}

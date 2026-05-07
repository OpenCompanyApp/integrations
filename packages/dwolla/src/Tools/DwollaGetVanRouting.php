<?php

namespace OpenCompany\Integrations\Dwolla\Tools;

/**
 * Retrieve VAN account and routing numbers.
 *
 * Maps to the official Dwolla endpoint GET /funding-sources/{id}/ach-routing.
 */
class DwollaGetVanRouting extends AbstractDwollaTool
{
    protected const NAME = 'dwolla_get_van_routing';
    protected const DESCRIPTION = 'Returns the unique account and routing numbers for a Virtual Account Number (VAN) funding source. These numbers can be used by external systems to initiate ACH transactions that pull funds from or push funds to the associated Dwolla balance.

Official Dwolla endpoint: GET /funding-sources/{id}/ach-routing.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'ID of VAN funding source to retrieve ACH details',
        ],
        'accept' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
            'enum' => ['application/vnd.dwolla.v1.hal+json'],
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/funding-sources/{id}/ach-routing';
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

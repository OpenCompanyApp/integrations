<?php

namespace OpenCompany\Integrations\Dwolla\Tools;

/**
 * List fees for a transfer.
 *
 * Maps to the official Dwolla endpoint GET /transfers/{id}/fees.
 */
class DwollaListTransferFees extends AbstractDwollaTool
{
    protected const NAME = 'dwolla_list_transfer_fees';
    protected const DESCRIPTION = 'Retrieve detailed fee information for a specific transfer by its unique identifier. Returns the total number of fees and individual fee transaction details including amounts, status, and links to source and destination accounts.

Official Dwolla endpoint: GET /transfers/{id}/fees.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'ID of transfer to retrieve fees for',
        ],
        'accept' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
            'enum' => ['application/vnd.dwolla.v1.hal+json'],
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/transfers/{id}/fees';
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

<?php

namespace OpenCompany\Integrations\Dwolla\Tools;

/**
 * Retrieve funding source balance.
 *
 * Maps to the official Dwolla endpoint GET /funding-sources/{id}/balance.
 */
class DwollaGetFundingSourceBalance extends AbstractDwollaTool
{
    protected const NAME = 'dwolla_get_funding_source_balance';
    protected const DESCRIPTION = 'Returns the current balance for a specific funding source. For bank accounts, includes available and closing balances; for Dwolla balance, includes balance and total amounts; for settlement accounts (bankUsageType = card-network), includes available balance only. Supports bank accounts (via Open Banking), Dwolla balance (verified customers only), and settlement accounts for card network processing.

Official Dwolla endpoint: GET /funding-sources/{id}/balance.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'ID of funding source to retrieve the balance for',
        ],
        'accept' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
            'enum' => ['application/vnd.dwolla.v1.hal+json'],
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/funding-sources/{id}/balance';
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

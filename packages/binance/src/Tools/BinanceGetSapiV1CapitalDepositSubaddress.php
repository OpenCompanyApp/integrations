<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Sub-account Spot Assets Summary (For Master Account).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/capital/deposit/subAddress.
 */
class BinanceGetSapiV1CapitalDepositSubaddress extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_capital_deposit_subaddress';
    protected const DESCRIPTION = 'Sub-account Spot Assets Summary (For Master Account)

Fetch sub-account deposit address Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/capital/deposit/subAddress.';
    protected const PARAMETERS = [
        'email' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Sub-account email',
        ],
        'coin' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Coin name',
        ],
        'network' => [
            'type' => 'string',
            'required' => false,
            'description' => 'query parameter `network`.',
        ],
        'recv_window' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'The value cannot be greater than 60000',
        ],
        'timestamp' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'UTC timestamp in ms',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/sapi/v1/capital/deposit/subAddress';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'email' => 'email',
        'coin' => 'coin',
        'network' => 'network',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}

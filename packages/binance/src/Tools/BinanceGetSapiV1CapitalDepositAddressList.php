<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Fetch deposit address list with network (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/capital/deposit/address/list.
 */
class BinanceGetSapiV1CapitalDepositAddressList extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_capital_deposit_address_list';
    protected const DESCRIPTION = 'Fetch deposit address list with network (USER_DATA)

Fetch deposit address list with network. Weight(IP): 10

Official Binance Spot endpoint: GET /sapi/v1/capital/deposit/address/list.';
    protected const PARAMETERS = [
        'coin' => [
            'type' => 'string',
            'required' => true,
            'description' => 'query parameter `coin`.',
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
    protected const PATH = '/sapi/v1/capital/deposit/address/list';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'coin' => 'coin',
        'network' => 'network',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}

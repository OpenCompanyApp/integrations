<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Deposit Address (supporting network) (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/capital/deposit/address.
 */
class BinanceGetSapiV1CapitalDepositAddress extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_capital_deposit_address';
    protected const DESCRIPTION = 'Deposit Address (supporting network) (USER_DATA)

Fetch deposit address with network. - If network is not send, return with default network of the coin. - You can get network and isDefault in networkList in the response of Get /sapi/v1/capital/config/getall (HMAC SHA256). Weight(IP): 10

Official Binance Spot endpoint: GET /sapi/v1/capital/deposit/address.';
    protected const PARAMETERS = [
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
    protected const PATH = '/sapi/v1/capital/deposit/address';
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

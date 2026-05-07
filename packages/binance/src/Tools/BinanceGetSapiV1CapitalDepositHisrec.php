<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Deposit History(supporting network) (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/capital/deposit/hisrec.
 */
class BinanceGetSapiV1CapitalDepositHisrec extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_capital_deposit_hisrec';
    protected const DESCRIPTION = 'Deposit History(supporting network) (USER_DATA)

Fetch deposit history. - Please notice the default `startTime` and `endTime` to make sure that time interval is within 0-90 days. - If both `startTime` and `endTime` are sent, time between `startTime` and `endTime` must be less than 90 days. Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/capital/deposit/hisrec.';
    protected const PARAMETERS = [
        'coin' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Coin name',
        ],
        'status' => [
            'type' => 'integer',
            'required' => false,
            'description' => '* `0` - pending * `6` - credited but cannot withdraw * `1` - success',
        ],
        'start_time' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'UTC timestamp in ms',
        ],
        'end_time' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'UTC timestamp in ms',
        ],
        'offset' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'query parameter `offset`.',
        ],
        'limit' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'Default 500; max 1000.',
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
    protected const PATH = '/sapi/v1/capital/deposit/hisrec';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'coin' => 'coin',
        'status' => 'status',
        'startTime' => 'start_time',
        'endTime' => 'end_time',
        'offset' => 'offset',
        'limit' => 'limit',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}

<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Get cross or isolated margin capital flow(USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/margin/capital-flow.
 */
class BinanceGetSapiV1MarginCapitalFlow extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_margin_capital_flow';
    protected const DESCRIPTION = 'Get cross or isolated margin capital flow(USER_DATA)

Get cross or isolated margin capital flow Weight(IP): 100

Official Binance Spot endpoint: GET /sapi/v1/margin/capital-flow.';
    protected const PARAMETERS = [
        'asset' => [
            'type' => 'string',
            'required' => false,
            'description' => 'query parameter `asset`.',
        ],
        'symbol' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Required when querying isolated data',
        ],
        'type' => [
            'type' => 'string',
            'required' => false,
            'description' => 'query parameter `type`.',
            'enum' => [
                'TRANSFER',
                'BORROW',
                'REPAY',
                'BUY_INCOME',
                'BUY_EXPENSE',
                'SELL_INCOME',
                'SELL_EXPENSE',
                'TRADING_COMMISSION',
                'BUY_LIQUIDATION',
                'SELL_LIQUIDATION',
                'REPAY_LIQUIDATION',
                'OTHER_LIQUIDATION',
                'LIQUIDATION_FEE',
                'SMALL_BALANCE_CONVERT',
                'COMMISSION_RETURN',
                'SMALL_CONVERT',
            ],
        ],
        'start_time' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'Only supports querying the data of the last 90 days',
        ],
        'end_time' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'UTC timestamp in ms',
        ],
        'from_id' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'If fromId is set, the data with id > fromId will be returned. Otherwise the latest data will be returned',
        ],
        'limit' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'The number of data items returned each time is limited. Default 500; Max 1000.',
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
    protected const PATH = '/sapi/v1/margin/capital-flow';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'asset' => 'asset',
        'symbol' => 'symbol',
        'type' => 'type',
        'startTime' => 'start_time',
        'endTime' => 'end_time',
        'fromId' => 'from_id',
        'limit' => 'limit',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}

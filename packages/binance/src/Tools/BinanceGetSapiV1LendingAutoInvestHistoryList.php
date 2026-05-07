<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Query subscription transaction history.
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/lending/auto-invest/history/list.
 */
class BinanceGetSapiV1LendingAutoInvestHistoryList extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_lending_auto_invest_history_list';
    protected const DESCRIPTION = 'Query subscription transaction history

Query subscription transaction history of a plan Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/lending/auto-invest/history/list.';
    protected const PARAMETERS = [
        'plan_id' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'query parameter `planId`.',
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
        'target_asset' => [
            'type' => 'number',
            'required' => false,
            'description' => 'query parameter `targetAsset`.',
        ],
        'plan_type' => [
            'type' => 'string',
            'required' => false,
            'description' => 'query parameter `planType`.',
            'enum' => [
                'SINGLE',
                'PORTFOLIO',
                'INDEX',
                'ALL',
            ],
        ],
        'size' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'Default:10 Max:100',
        ],
        'current' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'Current querying page. Start from 1. Default:1',
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
    protected const PATH = '/sapi/v1/lending/auto-invest/history/list';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'planId' => 'plan_id',
        'startTime' => 'start_time',
        'endTime' => 'end_time',
        'targetAsset' => 'target_asset',
        'planType' => 'plan_type',
        'size' => 'size',
        'current' => 'current',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}

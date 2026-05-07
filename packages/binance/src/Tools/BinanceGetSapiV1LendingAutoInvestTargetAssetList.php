<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Get target asset list (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/lending/auto-invest/target-asset/list.
 */
class BinanceGetSapiV1LendingAutoInvestTargetAssetList extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_lending_auto_invest_target_asset_list';
    protected const DESCRIPTION = 'Get target asset list (USER_DATA)

Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/lending/auto-invest/target-asset/list.';
    protected const PARAMETERS = [
        'target_asset' => [
            'type' => 'string',
            'required' => false,
            'description' => 'query parameter `targetAsset`.',
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
    protected const PATH = '/sapi/v1/lending/auto-invest/target-asset/list';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'targetAsset' => 'target_asset',
        'size' => 'size',
        'current' => 'current',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}

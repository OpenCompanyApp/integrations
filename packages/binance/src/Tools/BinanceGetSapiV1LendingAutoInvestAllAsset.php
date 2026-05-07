<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Query all source asset and target asset (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/lending/auto-invest/all/asset.
 */
class BinanceGetSapiV1LendingAutoInvestAllAsset extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_lending_auto_invest_all_asset';
    protected const DESCRIPTION = 'Query all source asset and target asset (USER_DATA)

Query all source assets and target assets Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/lending/auto-invest/all/asset.';
    protected const PARAMETERS = [
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
    protected const PATH = '/sapi/v1/lending/auto-invest/all/asset';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}

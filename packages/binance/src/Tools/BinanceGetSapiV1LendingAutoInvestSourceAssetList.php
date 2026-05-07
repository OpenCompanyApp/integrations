<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Query source asset list (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/lending/auto-invest/source-asset/list.
 */
class BinanceGetSapiV1LendingAutoInvestSourceAssetList extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_lending_auto_invest_source_asset_list';
    protected const DESCRIPTION = 'Query source asset list (USER_DATA)

Query Source Asset to be used for investment Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/lending/auto-invest/source-asset/list.';
    protected const PARAMETERS = [
        'target_asset' => [
            'type' => 'string',
            'required' => false,
            'description' => 'query parameter `targetAsset`.',
        ],
        'index_id' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'query parameter `indexId`.',
        ],
        'usage_type' => [
            'type' => 'string',
            'required' => true,
            'description' => 'query parameter `usageType`.',
        ],
        'flexible_allowed_to_use' => [
            'type' => 'boolean',
            'required' => false,
            'description' => 'query parameter `flexibleAllowedToUse`.',
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
    protected const PATH = '/sapi/v1/lending/auto-invest/source-asset/list';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'targetAsset' => 'target_asset',
        'indexId' => 'index_id',
        'usageType' => 'usage_type',
        'flexibleAllowedToUse' => 'flexible_allowed_to_use',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}

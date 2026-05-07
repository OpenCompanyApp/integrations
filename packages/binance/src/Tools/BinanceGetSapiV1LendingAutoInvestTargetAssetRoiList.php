<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Get target asset ROI data (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/lending/auto-invest/target-asset/roi/list.
 */
class BinanceGetSapiV1LendingAutoInvestTargetAssetRoiList extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_lending_auto_invest_target_asset_roi_list';
    protected const DESCRIPTION = 'Get target asset ROI data (USER_DATA)

ROI return list for target asset Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/lending/auto-invest/target-asset/roi/list.';
    protected const PARAMETERS = [
        'target_asset' => [
            'type' => 'string',
            'required' => true,
            'description' => 'query parameter `targetAsset`.',
        ],
        'his_roi_type' => [
            'type' => 'string',
            'required' => true,
            'description' => 'query parameter `hisRoiType`.',
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
    protected const PATH = '/sapi/v1/lending/auto-invest/target-asset/roi/list';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'targetAsset' => 'target_asset',
        'hisRoiType' => 'his_roi_type',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}

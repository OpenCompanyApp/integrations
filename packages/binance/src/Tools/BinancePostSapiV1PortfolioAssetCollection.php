<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Fund Collection by Asset (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint POST /sapi/v1/portfolio/asset-collection.
 */
class BinancePostSapiV1PortfolioAssetCollection extends AbstractBinanceTool
{
    protected const NAME = 'binance_post_sapi_v1_portfolio_asset_collection';
    protected const DESCRIPTION = 'Fund Collection by Asset (USER_DATA)

Transfers specific asset from Futures Account to Margin account Weight(IP): 60

Official Binance Spot endpoint: POST /sapi/v1/portfolio/asset-collection.';
    protected const PARAMETERS = [
        'asset' => [
            'type' => 'string',
            'required' => true,
            'description' => 'query parameter `asset`.',
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
    protected const METHOD = 'POST';
    protected const PATH = '/sapi/v1/portfolio/asset-collection';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'asset' => 'asset',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}

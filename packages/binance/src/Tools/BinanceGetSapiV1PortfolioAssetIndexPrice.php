<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Query Portfolio Margin Asset Index Price (MARKET_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/portfolio/asset-index-price.
 */
class BinanceGetSapiV1PortfolioAssetIndexPrice extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_portfolio_asset_index_price';
    protected const DESCRIPTION = 'Query Portfolio Margin Asset Index Price (MARKET_DATA)

Query Portfolio Margin Asset Index Price Weight(IP): - 1 if send asset - 50 if not send asset

Official Binance Spot endpoint: GET /sapi/v1/portfolio/asset-index-price.';
    protected const PARAMETERS = [
        'asset' => [
            'type' => 'string',
            'required' => false,
            'description' => 'query parameter `asset`.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/sapi/v1/portfolio/asset-index-price';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'asset' => 'asset',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'api_key';
}

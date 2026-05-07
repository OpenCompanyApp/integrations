<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Get Portfolio Margin Asset Leverage (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/portfolio/margin-asset-leverage.
 */
class BinanceGetSapiV1PortfolioMarginAssetLeverage extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_portfolio_margin_asset_leverage';
    protected const DESCRIPTION = 'Get Portfolio Margin Asset Leverage (USER_DATA)

Weight(IP): 50

Official Binance Spot endpoint: GET /sapi/v1/portfolio/margin-asset-leverage.';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '/sapi/v1/portfolio/margin-asset-leverage';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'public';
}

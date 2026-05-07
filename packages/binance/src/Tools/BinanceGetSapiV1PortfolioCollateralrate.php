<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Portfolio Margin Collateral Rate (MARKET_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/portfolio/collateralRate.
 */
class BinanceGetSapiV1PortfolioCollateralrate extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_portfolio_collateralrate';
    protected const DESCRIPTION = 'Portfolio Margin Collateral Rate (MARKET_DATA)

Portfolio Margin Collateral Rate. Weight(IP): 50

Official Binance Spot endpoint: GET /sapi/v1/portfolio/collateralRate.';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '/sapi/v1/portfolio/collateralRate';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'api_key';
}

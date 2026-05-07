<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Portfolio Margin Pro Tiered Collateral Rate(USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v2/portfolio/collateralRate.
 */
class BinanceGetSapiV2PortfolioCollateralrate extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v2_portfolio_collateralrate';
    protected const DESCRIPTION = 'Portfolio Margin Pro Tiered Collateral Rate(USER_DATA)

Portfolio Margin PRO Tiered Collateral Rate Weight(IP): 50

Official Binance Spot endpoint: GET /sapi/v2/portfolio/collateralRate.';
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
    protected const PATH = '/sapi/v2/portfolio/collateralRate';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}

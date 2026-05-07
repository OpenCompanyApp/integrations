<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Get Auto-repay-futures Status (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/portfolio/repay-futures-switch.
 */
class BinanceGetSapiV1PortfolioRepayFuturesSwitch extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_portfolio_repay_futures_switch';
    protected const DESCRIPTION = 'Get Auto-repay-futures Status (USER_DATA)

Query Auto-repay-futures Status Weight(IP): 30

Official Binance Spot endpoint: GET /sapi/v1/portfolio/repay-futures-switch.';
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
    protected const PATH = '/sapi/v1/portfolio/repay-futures-switch';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}

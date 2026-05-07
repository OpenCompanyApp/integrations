<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Change Auto-repay-futures Status (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint POST /sapi/v1/portfolio/repay-futures-switch.
 */
class BinancePostSapiV1PortfolioRepayFuturesSwitch extends AbstractBinanceTool
{
    protected const NAME = 'binance_post_sapi_v1_portfolio_repay_futures_switch';
    protected const DESCRIPTION = 'Change Auto-repay-futures Status (USER_DATA)

Change Auto-repay-futures Status Weight(IP): 1500

Official Binance Spot endpoint: POST /sapi/v1/portfolio/repay-futures-switch.';
    protected const PARAMETERS = [
        'auto_repay' => [
            'type' => 'boolean',
            'required' => true,
            'description' => 'query parameter `autoRepay`.',
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
    protected const PATH = '/sapi/v1/portfolio/repay-futures-switch';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'autoRepay' => 'auto_repay',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}

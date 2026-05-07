<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Repay futures Negative Balance (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint POST /sapi/v1/portfolio/repay-futures-negative-balance.
 */
class BinancePostSapiV1PortfolioRepayFuturesNegativeBalance extends AbstractBinanceTool
{
    protected const NAME = 'binance_post_sapi_v1_portfolio_repay_futures_negative_balance';
    protected const DESCRIPTION = 'Repay futures Negative Balance (USER_DATA)

Repay futures Negative Balance Weight(IP): 1500

Official Binance Spot endpoint: POST /sapi/v1/portfolio/repay-futures-negative-balance.';
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
    protected const METHOD = 'POST';
    protected const PATH = '/sapi/v1/portfolio/repay-futures-negative-balance';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}

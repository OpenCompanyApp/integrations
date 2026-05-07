<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Portfolio Margin Bankruptcy Loan Repay (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint POST /sapi/v1/portfolio/repay.
 */
class BinancePostSapiV1PortfolioRepay extends AbstractBinanceTool
{
    protected const NAME = 'binance_post_sapi_v1_portfolio_repay';
    protected const DESCRIPTION = 'Portfolio Margin Bankruptcy Loan Repay (USER_DATA)

Repay Portfolio Margin Bankruptcy Loan. Weight(UID): 3000

Official Binance Spot endpoint: POST /sapi/v1/portfolio/repay.';
    protected const PARAMETERS = [
        'from' => [
            'type' => 'string',
            'required' => false,
            'description' => 'query parameter `from`.',
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
    protected const PATH = '/sapi/v1/portfolio/repay';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'from' => 'from',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}

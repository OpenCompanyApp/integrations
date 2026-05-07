<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Portfolio Margin Bankruptcy Loan Amount (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/portfolio/pmLoan.
 */
class BinanceGetSapiV1PortfolioPmloan extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_portfolio_pmloan';
    protected const DESCRIPTION = 'Portfolio Margin Bankruptcy Loan Amount (USER_DATA)

Query Portfolio Margin Bankruptcy Loan Amount. Weight(UID): 500

Official Binance Spot endpoint: GET /sapi/v1/portfolio/pmLoan.';
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
    protected const PATH = '/sapi/v1/portfolio/pmLoan';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}

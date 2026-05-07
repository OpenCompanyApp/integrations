<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Query Classic Portfolio Margin Negative Balance Interest History (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/portfolio/interest-history.
 */
class BinanceGetSapiV1PortfolioInterestHistory extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_portfolio_interest_history';
    protected const DESCRIPTION = 'Query Classic Portfolio Margin Negative Balance Interest History (USER_DATA)

Query interest history of negative balance for portfolio margin. Weight(IP): 50

Official Binance Spot endpoint: GET /sapi/v1/portfolio/interest-history.';
    protected const PARAMETERS = [
        'asset' => [
            'type' => 'string',
            'required' => true,
            'description' => 'query parameter `asset`.',
        ],
        'start_time' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'UTC timestamp in ms',
        ],
        'end_time' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'UTC timestamp in ms',
        ],
        'size' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'Default:10 Max:100',
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
    protected const METHOD = 'GET';
    protected const PATH = '/sapi/v1/portfolio/interest-history';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'asset' => 'asset',
        'startTime' => 'start_time',
        'endTime' => 'end_time',
        'size' => 'size',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}

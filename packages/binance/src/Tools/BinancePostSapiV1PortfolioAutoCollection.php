<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Fund Auto-collection (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint POST /sapi/v1/portfolio/auto-collection.
 */
class BinancePostSapiV1PortfolioAutoCollection extends AbstractBinanceTool
{
    protected const NAME = 'binance_post_sapi_v1_portfolio_auto_collection';
    protected const DESCRIPTION = 'Fund Auto-collection (USER_DATA)

Transfers all assets from Futures Account to Margin account Weight(IP): 1500

Official Binance Spot endpoint: POST /sapi/v1/portfolio/auto-collection.';
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
    protected const PATH = '/sapi/v1/portfolio/auto-collection';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}

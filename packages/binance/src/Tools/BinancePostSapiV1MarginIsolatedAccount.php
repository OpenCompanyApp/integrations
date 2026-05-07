<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Enable Isolated Margin Account (TRADE).
 *
 * Maps to the official Binance Spot endpoint POST /sapi/v1/margin/isolated/account.
 */
class BinancePostSapiV1MarginIsolatedAccount extends AbstractBinanceTool
{
    protected const NAME = 'binance_post_sapi_v1_margin_isolated_account';
    protected const DESCRIPTION = 'Enable Isolated Margin Account (TRADE)

Enable isolated margin account for a specific symbol. Weight(UID): 300

Official Binance Spot endpoint: POST /sapi/v1/margin/isolated/account.';
    protected const PARAMETERS = [
        'symbol' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Trading symbol, e.g. BNBUSDT',
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
    protected const PATH = '/sapi/v1/margin/isolated/account';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'symbol' => 'symbol',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}

<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Disable Isolated Margin Account (TRADE).
 *
 * Maps to the official Binance Spot endpoint DELETE /sapi/v1/margin/isolated/account.
 */
class BinanceDeleteSapiV1MarginIsolatedAccount extends AbstractBinanceTool
{
    protected const NAME = 'binance_delete_sapi_v1_margin_isolated_account';
    protected const DESCRIPTION = 'Disable Isolated Margin Account (TRADE)

Disable isolated margin account for a specific symbol. Each trading pair can only be deactivated once every 24 hours . Weight(UID): 300

Official Binance Spot endpoint: DELETE /sapi/v1/margin/isolated/account.';
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
    protected const METHOD = 'DELETE';
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

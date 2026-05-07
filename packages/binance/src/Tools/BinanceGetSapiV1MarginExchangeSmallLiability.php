<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Get Small Liability Exchange Coin List (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/margin/exchange-small-liability.
 */
class BinanceGetSapiV1MarginExchangeSmallLiability extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_margin_exchange_small_liability';
    protected const DESCRIPTION = 'Get Small Liability Exchange Coin List (USER_DATA)

Query the coins which can be small liability exchange Weight(UID): 100

Official Binance Spot endpoint: GET /sapi/v1/margin/exchange-small-liability.';
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
    protected const PATH = '/sapi/v1/margin/exchange-small-liability';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}

<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Query Prevented Matches.
 *
 * Maps to the official Binance Spot endpoint GET /api/v3/myPreventedMatches.
 */
class BinanceGetApiV3Mypreventedmatches extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_api_v3_mypreventedmatches';
    protected const DESCRIPTION = 'Query Prevented Matches

Displays the list of orders that were expired because of STP. For additional information on what a Prevented match is, as well as Self Trade Prevention (STP), please refer to our STP FAQ page. These are the combinations supported: * symbol + preventedMatchId * symbol + orderId * symbol + orderId + fromPreventedMatchId (limit will default to 500) * symbol + orderId + fromPreventedMatchId + limit Weight(IP): Case Weight If symbol is invalid: 2 Querying by preventedMatchId: 2 Querying by orderId: 20

Official Binance Spot endpoint: GET /api/v3/myPreventedMatches.';
    protected const PARAMETERS = [
        'symbol' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Trading symbol, e.g. BNBUSDT',
        ],
        'prevented_match_id' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'query parameter `preventedMatchId`.',
        ],
        'order_id' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'Order id',
        ],
        'from_prevented_match_id' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'query parameter `fromPreventedMatchId`.',
        ],
        'limit' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'Default 500; max 1000.',
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
    protected const PATH = '/api/v3/myPreventedMatches';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'symbol' => 'symbol',
        'preventedMatchId' => 'prevented_match_id',
        'orderId' => 'order_id',
        'fromPreventedMatchId' => 'from_prevented_match_id',
        'limit' => 'limit',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}

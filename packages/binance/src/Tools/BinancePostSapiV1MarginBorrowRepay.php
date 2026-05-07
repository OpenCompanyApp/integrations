<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Margin account borrow/repay(MARGIN).
 *
 * Maps to the official Binance Spot endpoint POST /sapi/v1/margin/borrow-repay.
 */
class BinancePostSapiV1MarginBorrowRepay extends AbstractBinanceTool
{
    protected const NAME = 'binance_post_sapi_v1_margin_borrow_repay';
    protected const DESCRIPTION = 'Margin account borrow/repay(MARGIN)

Margin account borrow/repay(MARGIN) Weight(UID): 3000

Official Binance Spot endpoint: POST /sapi/v1/margin/borrow-repay.';
    protected const PARAMETERS = [
        'asset' => [
            'type' => 'string',
            'required' => true,
            'description' => 'query parameter `asset`.',
        ],
        'is_isolated' => [
            'type' => 'string',
            'required' => true,
            'description' => 'TRUE for isolated margin, FALSE for crossed margin',
        ],
        'symbol' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Trading symbol, e.g. BNBUSDT',
        ],
        'amount' => [
            'type' => 'number',
            'required' => true,
            'description' => 'query parameter `amount`.',
        ],
        'type' => [
            'type' => 'string',
            'required' => true,
            'description' => 'BORROW or REPAY',
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
    protected const PATH = '/sapi/v1/margin/borrow-repay';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'asset' => 'asset',
        'isIsolated' => 'is_isolated',
        'symbol' => 'symbol',
        'amount' => 'amount',
        'type' => 'type',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}

<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * New Future Account Transfer (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint POST /sapi/v1/futures/transfer.
 */
class BinancePostSapiV1FuturesTransfer extends AbstractBinanceTool
{
    protected const NAME = 'binance_post_sapi_v1_futures_transfer';
    protected const DESCRIPTION = 'New Future Account Transfer (USER_DATA)

Execute transfer between spot account and futures account. Weight(IP): 1

Official Binance Spot endpoint: POST /sapi/v1/futures/transfer.';
    protected const PARAMETERS = [
        'asset' => [
            'type' => 'string',
            'required' => true,
            'description' => 'query parameter `asset`.',
        ],
        'amount' => [
            'type' => 'number',
            'required' => true,
            'description' => 'query parameter `amount`.',
        ],
        'type' => [
            'type' => 'integer',
            'required' => true,
            'description' => '1: transfer from spot account to USDT-Ⓜ futures account. 2: transfer from USDT-Ⓜ futures account to spot account. 3: transfer from spot account to COIN-Ⓜ futures account. 4: transfer from COIN-Ⓜ futures account to spot account.',
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
    protected const PATH = '/sapi/v1/futures/transfer';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'asset' => 'asset',
        'amount' => 'amount',
        'type' => 'type',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}

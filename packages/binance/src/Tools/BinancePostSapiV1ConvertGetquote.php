<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Send quote request (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint POST /sapi/v1/convert/getQuote.
 */
class BinancePostSapiV1ConvertGetquote extends AbstractBinanceTool
{
    protected const NAME = 'binance_post_sapi_v1_convert_getquote';
    protected const DESCRIPTION = 'Send quote request (USER_DATA)

Request a quote for the requested token pairs Weight(UID): 200

Official Binance Spot endpoint: POST /sapi/v1/convert/getQuote.';
    protected const PARAMETERS = [
        'from_asset' => [
            'type' => 'string',
            'required' => true,
            'description' => 'query parameter `fromAsset`.',
        ],
        'to_asset' => [
            'type' => 'string',
            'required' => true,
            'description' => 'query parameter `toAsset`.',
        ],
        'from_amount' => [
            'type' => 'number',
            'required' => false,
            'description' => 'When specified, it is the amount you will be debited after the conversion',
        ],
        'to_amount' => [
            'type' => 'number',
            'required' => false,
            'description' => 'When specified, it is the amount you will be debited after the conversion',
        ],
        'valid_time' => [
            'type' => 'string',
            'required' => false,
            'description' => '10s, 30s, 1m, 2m, default 10s',
        ],
        'wallet_type' => [
            'type' => 'string',
            'required' => false,
            'description' => 'SPOT or FUNDING. Default is SPOT',
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
    protected const PATH = '/sapi/v1/convert/getQuote';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'fromAsset' => 'from_asset',
        'toAsset' => 'to_asset',
        'fromAmount' => 'from_amount',
        'toAmount' => 'to_amount',
        'validTime' => 'valid_time',
        'walletType' => 'wallet_type',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}

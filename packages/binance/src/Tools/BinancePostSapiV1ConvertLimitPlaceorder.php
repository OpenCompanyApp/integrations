<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Place limit order (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint POST /sapi/v1/convert/limit/placeOrder.
 */
class BinancePostSapiV1ConvertLimitPlaceorder extends AbstractBinanceTool
{
    protected const NAME = 'binance_post_sapi_v1_convert_limit_placeorder';
    protected const DESCRIPTION = 'Place limit order (USER_DATA)

Enable users to place a limit order - baseAsset or quoteAsset can be determined via exchangeInfo endpoint. - Limit price is defined from baseAsset to quoteAsset. - Either baseAmount or quoteAmount is used. Weight(UID): 500

Official Binance Spot endpoint: POST /sapi/v1/convert/limit/placeOrder.';
    protected const PARAMETERS = [
        'base_asset' => [
            'type' => 'string',
            'required' => true,
            'description' => 'query parameter `baseAsset`.',
        ],
        'quote_asset' => [
            'type' => 'string',
            'required' => true,
            'description' => 'query parameter `quoteAsset`.',
        ],
        'limit_price' => [
            'type' => 'number',
            'required' => true,
            'description' => 'Symbol limit price (from baseAsset to quoteAsset)',
        ],
        'base_amount' => [
            'type' => 'number',
            'required' => false,
            'description' => 'Base asset amount. (One of baseAmount or quoteAmount is required)',
        ],
        'quote_amount' => [
            'type' => 'number',
            'required' => false,
            'description' => 'Quote asset amount. (One of baseAmount or quoteAmount is required)',
        ],
        'side' => [
            'type' => 'string',
            'required' => true,
            'description' => 'query parameter `side`.',
            'enum' => [
                'SELL',
                'BUY',
            ],
        ],
        'wallet_type' => [
            'type' => 'string',
            'required' => false,
            'description' => 'SPOT or FUNDING or SPOT_FUNDING. It is to use which type of assets. Default is SPOT.',
            'enum' => [
                'SPOT',
                'FUNDING',
                'SPOT_FUNDING',
            ],
        ],
        'expired_type' => [
            'type' => 'string',
            'required' => false,
            'description' => '1_D, 3_D, 7_D, 30_D (D means day)',
            'enum' => [
                '1_D',
                '3_D',
                '7_D',
                '30_D',
            ],
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
    protected const PATH = '/sapi/v1/convert/limit/placeOrder';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'baseAsset' => 'base_asset',
        'quoteAsset' => 'quote_asset',
        'limitPrice' => 'limit_price',
        'baseAmount' => 'base_amount',
        'quoteAmount' => 'quote_amount',
        'side' => 'side',
        'walletType' => 'wallet_type',
        'expiredType' => 'expired_type',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}

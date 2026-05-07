<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Redeem Flexible Product (TRADE).
 *
 * Maps to the official Binance Spot endpoint POST /sapi/v1/simple-earn/flexible/redeem.
 */
class BinancePostSapiV1SimpleEarnFlexibleRedeem extends AbstractBinanceTool
{
    protected const NAME = 'binance_post_sapi_v1_simple_earn_flexible_redeem';
    protected const DESCRIPTION = 'Redeem Flexible Product (TRADE)

Weight(IP): 1 Rate Limit: 1/3s per account

Official Binance Spot endpoint: POST /sapi/v1/simple-earn/flexible/redeem.';
    protected const PARAMETERS = [
        'product_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'query parameter `productId`.',
        ],
        'redeem_all' => [
            'type' => 'boolean',
            'required' => false,
            'description' => 'true or false, default to false',
        ],
        'amount' => [
            'type' => 'number',
            'required' => false,
            'description' => 'if redeemAll is false, amount is mandatory',
        ],
        'dest_account' => [
            'type' => 'string',
            'required' => false,
            'description' => 'SPOT,FUND,ALL, default SPOT',
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
    protected const PATH = '/sapi/v1/simple-earn/flexible/redeem';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'productId' => 'product_id',
        'redeemAll' => 'redeem_all',
        'amount' => 'amount',
        'destAccount' => 'dest_account',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}

<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Fetch Token Limit (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/giftcard/buyCode/token-limit.
 */
class BinanceGetSapiV1GiftcardBuycodeTokenLimit extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_giftcard_buycode_token_limit';
    protected const DESCRIPTION = 'Fetch Token Limit (USER_DATA)

This API is to help you verify which tokens are available for you to purchase fixed-value gift cards as mentioned in section 2 and it\'s limitation. Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/giftcard/buyCode/token-limit.';
    protected const PARAMETERS = [
        'base_token' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The token you want to pay, example BUSD',
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
    protected const PATH = '/sapi/v1/giftcard/buyCode/token-limit';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'baseToken' => 'base_token',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}

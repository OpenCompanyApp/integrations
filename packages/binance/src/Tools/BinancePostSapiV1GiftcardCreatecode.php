<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Create a Binance Code (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint POST /sapi/v1/giftcard/createCode.
 */
class BinancePostSapiV1GiftcardCreatecode extends AbstractBinanceTool
{
    protected const NAME = 'binance_post_sapi_v1_giftcard_createcode';
    protected const DESCRIPTION = 'Create a Binance Code (USER_DATA)

This API is for creating a Binance Code. To get started with, please make sure: - You have a Binance account - You have passed kyc - You have a sufficient balance in your Binance funding wallet - You need Enable Withdrawals for the API Key which requests this endpoint. Daily creation volume: 2 BTC / 24H Daily creation times: 200 Codes / 24H Weight(IP): 1

Official Binance Spot endpoint: POST /sapi/v1/giftcard/createCode.';
    protected const PARAMETERS = [
        'token' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The coin type contained in the Binance Code',
        ],
        'amount' => [
            'type' => 'number',
            'required' => true,
            'description' => 'The amount of the coin',
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
    protected const PATH = '/sapi/v1/giftcard/createCode';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'token' => 'token',
        'amount' => 'amount',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}

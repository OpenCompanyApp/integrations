<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Buy a Binance Code (TRADE).
 *
 * Maps to the official Binance Spot endpoint POST /sapi/v1/giftcard/buyCode.
 */
class BinancePostSapiV1GiftcardBuycode extends AbstractBinanceTool
{
    protected const NAME = 'binance_post_sapi_v1_giftcard_buycode';
    protected const DESCRIPTION = 'Buy a Binance Code (TRADE)

This API is for buying a fixed-value Binance Code, which means your Binance Code will be redeemable to a token that is different to the token that you are paying in. If the token you’re paying and the redeemable token are the same, please use the Create Binance Code endpoint. You can use supported crypto currency or fiat token as baseToken to buy Binance Code that is redeemable to your chosen faceToken. Once successfully purchased, the amount of baseToken would be deducted from your funding wallet. To get started with, please make sure: - You have a Binance account - You have passed kyc - You have a sufficient balance in your Binance funding wallet - You need Enable Withdrawals for the API Key which requests this endpoint. Daily creation volume: 2 BTC / 24H Daily creation times: 200 Codes / 24H Weight(IP): 1

Official Binance Spot endpoint: POST /sapi/v1/giftcard/buyCode.';
    protected const PARAMETERS = [
        'base_token' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The token you want to pay, example BUSD',
        ],
        'face_token' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The token you want to buy, example BNB. If faceToken = baseToken, it\'s the same as createCode endpoint.',
        ],
        'base_token_amount' => [
            'type' => 'number',
            'required' => true,
            'description' => 'The base token asset quantity, example 1.002',
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
    protected const PATH = '/sapi/v1/giftcard/buyCode';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'baseToken' => 'base_token',
        'faceToken' => 'face_token',
        'baseTokenAmount' => 'base_token_amount',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}

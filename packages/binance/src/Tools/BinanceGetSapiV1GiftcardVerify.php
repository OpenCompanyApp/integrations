<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Verify a Binance Code (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/giftcard/verify.
 */
class BinanceGetSapiV1GiftcardVerify extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_giftcard_verify';
    protected const DESCRIPTION = 'Verify a Binance Code (USER_DATA)

This API is for verifying whether the Binance Code is valid or not by entering Binance Code or reference number. Please note that if you enter the wrong binance code 5 times within an hour, you will no longer be able to verify any binance code for that hour. Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/giftcard/verify.';
    protected const PARAMETERS = [
        'reference_no' => [
            'type' => 'string',
            'required' => true,
            'description' => 'reference number',
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
    protected const PATH = '/sapi/v1/giftcard/verify';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'referenceNo' => 'reference_no',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}

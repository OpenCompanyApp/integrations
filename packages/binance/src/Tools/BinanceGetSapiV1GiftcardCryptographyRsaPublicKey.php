<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Fetch RSA Public Key (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/giftcard/cryptography/rsa-public-key.
 */
class BinanceGetSapiV1GiftcardCryptographyRsaPublicKey extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_giftcard_cryptography_rsa_public_key';
    protected const DESCRIPTION = 'Fetch RSA Public Key (USER_DATA)

This API is for fetching the RSA Public Key. This RSA Public key will be used to encrypt the card code. Please note that the RSA Public key fetched is valid only for the current day. Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/giftcard/cryptography/rsa-public-key.';
    protected const PARAMETERS = [
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
    protected const PATH = '/sapi/v1/giftcard/cryptography/rsa-public-key';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}

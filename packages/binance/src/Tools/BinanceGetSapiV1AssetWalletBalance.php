<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Query User Wallet Balance (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/asset/wallet/balance.
 */
class BinanceGetSapiV1AssetWalletBalance extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_asset_wallet_balance';
    protected const DESCRIPTION = 'Query User Wallet Balance (USER_DATA)

Query User Wallet Balance Weight(IP): 60

Official Binance Spot endpoint: GET /sapi/v1/asset/wallet/balance.';
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
    protected const PATH = '/sapi/v1/asset/wallet/balance';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}

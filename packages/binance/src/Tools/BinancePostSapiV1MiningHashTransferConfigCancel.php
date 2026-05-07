<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Cancel Hashrate Resale configuration (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint POST /sapi/v1/mining/hash-transfer/config/cancel.
 */
class BinancePostSapiV1MiningHashTransferConfigCancel extends AbstractBinanceTool
{
    protected const NAME = 'binance_post_sapi_v1_mining_hash_transfer_config_cancel';
    protected const DESCRIPTION = 'Cancel Hashrate Resale configuration (USER_DATA)

Weight(IP): 5

Official Binance Spot endpoint: POST /sapi/v1/mining/hash-transfer/config/cancel.';
    protected const PARAMETERS = [
        'config_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Mining ID',
        ],
        'user_name' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Mining Account',
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
    protected const PATH = '/sapi/v1/mining/hash-transfer/config/cancel';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'configId' => 'config_id',
        'userName' => 'user_name',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}

<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Hashrate Resale Details (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/mining/hash-transfer/profit/details.
 */
class BinanceGetSapiV1MiningHashTransferProfitDetails extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_mining_hash_transfer_profit_details';
    protected const DESCRIPTION = 'Hashrate Resale Details (USER_DATA)

Weight(IP): 5

Official Binance Spot endpoint: GET /sapi/v1/mining/hash-transfer/profit/details.';
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
        'page_index' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'Page number, default is first page, start form 1',
        ],
        'page_size' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Number of pages, minimum 10, maximum 200',
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
    protected const PATH = '/sapi/v1/mining/hash-transfer/profit/details';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'configId' => 'config_id',
        'userName' => 'user_name',
        'pageIndex' => 'page_index',
        'pageSize' => 'page_size',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}

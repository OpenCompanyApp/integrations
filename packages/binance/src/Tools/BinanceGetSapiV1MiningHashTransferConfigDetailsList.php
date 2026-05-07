<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Hashrate Resale List (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/mining/hash-transfer/config/details/list.
 */
class BinanceGetSapiV1MiningHashTransferConfigDetailsList extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_mining_hash_transfer_config_details_list';
    protected const DESCRIPTION = 'Hashrate Resale List (USER_DATA)

Weight(IP): 5

Official Binance Spot endpoint: GET /sapi/v1/mining/hash-transfer/config/details/list.';
    protected const PARAMETERS = [
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
    protected const PATH = '/sapi/v1/mining/hash-transfer/config/details/list';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'pageIndex' => 'page_index',
        'pageSize' => 'page_size',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}

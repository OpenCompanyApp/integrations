<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Request for Miner List (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/mining/worker/list.
 */
class BinanceGetSapiV1MiningWorkerList extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_mining_worker_list';
    protected const DESCRIPTION = 'Request for Miner List (USER_DATA)

Weight(IP): 5

Official Binance Spot endpoint: GET /sapi/v1/mining/worker/list.';
    protected const PARAMETERS = [
        'algo' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Algorithm(sha256)',
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
        'sort' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'sort sequence(default=0)0 positive sequence, 1 negative sequence',
        ],
        'sort_column' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'Sort by( default 1): 1: miner name, 2: real-time computing power, 3: daily average computing power, 4: real-time rejection rate, 5: last submission time',
        ],
        'worker_status' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'miners status(default=0)0 all, 1 valid, 2 invalid, 3 failure',
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
    protected const PATH = '/sapi/v1/mining/worker/list';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'algo' => 'algo',
        'userName' => 'user_name',
        'pageIndex' => 'page_index',
        'sort' => 'sort',
        'sortColumn' => 'sort_column',
        'workerStatus' => 'worker_status',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}

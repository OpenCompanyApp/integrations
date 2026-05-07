<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Extra Bonus List (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/mining/payment/other.
 */
class BinanceGetSapiV1MiningPaymentOther extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_mining_payment_other';
    protected const DESCRIPTION = 'Extra Bonus List (USER_DATA)

Weight(IP): 5

Official Binance Spot endpoint: GET /sapi/v1/mining/payment/other.';
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
        'coin' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Coin name',
        ],
        'start_date' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Search date, millisecond timestamp, while empty query all',
        ],
        'end_date' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Search date, millisecond timestamp, while empty query all',
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
    protected const PATH = '/sapi/v1/mining/payment/other';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'algo' => 'algo',
        'userName' => 'user_name',
        'coin' => 'coin',
        'startDate' => 'start_date',
        'endDate' => 'end_date',
        'pageIndex' => 'page_index',
        'pageSize' => 'page_size',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}

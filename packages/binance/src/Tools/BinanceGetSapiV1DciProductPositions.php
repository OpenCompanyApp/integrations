<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Get Dual Investment positions(USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/dci/product/positions.
 */
class BinanceGetSapiV1DciProductPositions extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_dci_product_positions';
    protected const DESCRIPTION = 'Get Dual Investment positions(USER_DATA)

Get Dual Investment positions (batch) Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/dci/product/positions.';
    protected const PARAMETERS = [
        'status' => [
            'type' => 'string',
            'required' => false,
            'description' => '- PENDING: Products are purchasing, will give results later; - PURCHASE_SUCCESS: purchase successfully; - SETTLED: Products are finish settling; - PURCHASE_FAIL: fail to purchase; - REFUNDING: refund ongoing; - REFUND_SUCCESS: refund to spot account successfully; - SETTLING: Products are settling. If don\'t fill this field, will response all the position status.',
            'enum' => [
                'PENDING',
                'PURCHASE_SUCCESS',
                'SETTLED',
                'PURCHASE_FAIL',
                'REFUNDING',
                'REFUND_SUCCESS',
                'SETTLING',
            ],
        ],
        'page_size' => [
            'type' => 'string',
            'required' => false,
            'description' => 'MIN 1, MAX 100; Default 100',
        ],
        'page_index' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'Page number, default is first page, start form 1',
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
    protected const PATH = '/sapi/v1/dci/product/positions';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'status' => 'status',
        'pageSize' => 'page_size',
        'pageIndex' => 'page_index',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}

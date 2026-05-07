<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Get Dual Investment product list(USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/dci/product/list.
 */
class BinanceGetSapiV1DciProductList extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_dci_product_list';
    protected const DESCRIPTION = 'Get Dual Investment product list(USER_DATA)

Get Dual Investment product list Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/dci/product/list.';
    protected const PARAMETERS = [
        'option_type' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Input CALL or PUT',
            'enum' => [
                'CALL',
                'PUT',
            ],
        ],
        'exercised_coin' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Target exercised asset, e.g.: if you subscribe to a high sell product (call option), you should input: - optionType: CALL, - exercisedCoin: USDT, - investCoin: BNB; if you subscribe to a low buy product (put option), you should input: - optionType: PUT, - exercisedCoin: BNB, - investCoin: USDT;',
        ],
        'invest_coin' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Asset used for subscribing, e.g.: if you subscribe to a high sell product (call option), you should input: - optionType: CALL, - exercisedCoin: USDT, - investCoin: BNB; if you subscribe to a low buy product (put option), you should input: - optionType: PUT, - exercisedCoin: BNB, - investCoin: USDT;',
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
    protected const PATH = '/sapi/v1/dci/product/list';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'optionType' => 'option_type',
        'exercisedCoin' => 'exercised_coin',
        'investCoin' => 'invest_coin',
        'pageSize' => 'page_size',
        'pageIndex' => 'page_index',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}

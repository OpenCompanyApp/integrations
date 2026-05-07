<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Exchange Information.
 *
 * Maps to the official Binance Spot endpoint GET /api/v3/exchangeInfo.
 */
class BinanceGetApiV3Exchangeinfo extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_api_v3_exchangeinfo';
    protected const DESCRIPTION = 'Exchange Information

Current exchange trading rules and symbol information - If any symbol provided in either symbol or symbols do not exist, the endpoint will throw an error. - All parameters are optional. - permissions can support single or multiple values (e.g. SPOT, ["MARGIN","LEVERAGED"]) - If permissions parameter not provided, the default values will be ["SPOT","MARGIN","LEVERAGED"]. - To display all permissions you need to specify them explicitly. (e.g. SPOT, MARGIN,...) Examples of Symbol Permissions Interpretation from the Response: - [["A","B"]] means you may place an order if your account has either permission "A" or permission "B". - [["A"],["B"]] means you can place an order if your account has permission "A" and permission "B". - [["A"],["B","C"]] means you can place an order if your account has permission "A" and permission "B" or permission "C". (Inclusive or is applied here, not exclusive or, so your account may have both permission "B" and permission "C".) Weight(IP): 10

Official Binance Spot endpoint: GET /api/v3/exchangeInfo.';
    protected const PARAMETERS = [
        'symbol' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Trading symbol, e.g. BNBUSDT',
        ],
        'symbols' => [
            'type' => 'string',
            'required' => false,
            'description' => 'query parameter `symbols`.',
        ],
        'permissions' => [
            'type' => 'string',
            'required' => false,
            'description' => 'query parameter `permissions`.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v3/exchangeInfo';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'symbol' => 'symbol',
        'symbols' => 'symbols',
        'permissions' => 'permissions',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'public';
}

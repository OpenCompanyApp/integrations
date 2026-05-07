<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Get Collateral Assets Data (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/loan/collateral/data.
 */
class BinanceGetSapiV1LoanCollateralData extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_loan_collateral_data';
    protected const DESCRIPTION = 'Get Collateral Assets Data (USER_DATA)

Get LTV information and collateral limit of collateral assets. The collateral limit is shown in USD value. Weight(IP): 400

Official Binance Spot endpoint: GET /sapi/v1/loan/collateral/data.';
    protected const PARAMETERS = [
        'collateral_coin' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Coin used as collateral',
        ],
        'vip_level' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'Defaults to user\'s vip level',
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
    protected const PATH = '/sapi/v1/loan/collateral/data';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'collateralCoin' => 'collateral_coin',
        'vipLevel' => 'vip_level',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}

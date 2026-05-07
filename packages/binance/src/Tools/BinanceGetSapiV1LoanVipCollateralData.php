<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Get Collateral Asset Data (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/loan/vip/collateral/data.
 */
class BinanceGetSapiV1LoanVipCollateralData extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_loan_vip_collateral_data';
    protected const DESCRIPTION = 'Get Collateral Asset Data (USER_DATA)

Get collateral asset data. Weight(IP): 400

Official Binance Spot endpoint: GET /sapi/v1/loan/vip/collateral/data.';
    protected const PARAMETERS = [
        'collateral_coin' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Coin used as collateral',
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
    protected const PATH = '/sapi/v1/loan/vip/collateral/data';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'collateralCoin' => 'collateral_coin',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}

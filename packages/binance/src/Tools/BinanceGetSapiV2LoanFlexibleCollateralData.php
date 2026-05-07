<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Get Flexible Loan Collateral Assets Data (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v2/loan/flexible/collateral/data.
 */
class BinanceGetSapiV2LoanFlexibleCollateralData extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v2_loan_flexible_collateral_data';
    protected const DESCRIPTION = 'Get Flexible Loan Collateral Assets Data (USER_DATA)

Get LTV information and collateral limit of flexible loan\'s collateral assets. The collateral limit is shown in USD value. Weight(IP): 400

Official Binance Spot endpoint: GET /sapi/v2/loan/flexible/collateral/data.';
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
    protected const PATH = '/sapi/v2/loan/flexible/collateral/data';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'collateralCoin' => 'collateral_coin',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}

<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Check Collateral Repay Rate (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/loan/repay/collateral/rate.
 */
class BinanceGetSapiV1LoanRepayCollateralRate extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_loan_repay_collateral_rate';
    protected const DESCRIPTION = 'Check Collateral Repay Rate (USER_DATA)

Get the the rate of collateral coin / loan coin when using collateral repay, the rate will be valid within 8 second. Weight(IP): 6000

Official Binance Spot endpoint: GET /sapi/v1/loan/repay/collateral/rate.';
    protected const PARAMETERS = [
        'loan_coin' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Coin loaned',
        ],
        'collateral_coin' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Coin used as collateral',
        ],
        'repay_amount' => [
            'type' => 'number',
            'required' => true,
            'description' => 'repay amount of loanCoin',
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
    protected const PATH = '/sapi/v1/loan/repay/collateral/rate';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'loanCoin' => 'loan_coin',
        'collateralCoin' => 'collateral_coin',
        'repayAmount' => 'repay_amount',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}

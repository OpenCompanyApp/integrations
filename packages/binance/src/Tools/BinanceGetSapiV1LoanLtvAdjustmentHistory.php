<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Get Loan LTV Adjustment History (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/loan/ltv/adjustment/history.
 */
class BinanceGetSapiV1LoanLtvAdjustmentHistory extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_loan_ltv_adjustment_history';
    protected const DESCRIPTION = 'Get Loan LTV Adjustment History (USER_DATA)

If startTime and endTime are not sent, the recent 90-day data will be returned. The max interval between startTime and endTime is 180 days. Weight(IP): 400

Official Binance Spot endpoint: GET /sapi/v1/loan/ltv/adjustment/history.';
    protected const PARAMETERS = [
        'order_id' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'Order ID',
        ],
        'loan_coin' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Coin loaned',
        ],
        'collateral_coin' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Coin used as collateral',
        ],
        'start_time' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'UTC timestamp in ms',
        ],
        'end_time' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'UTC timestamp in ms',
        ],
        'current' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'Current querying page. Start from 1. Default:1',
        ],
        'limit' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'default 10, max 100',
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
    protected const PATH = '/sapi/v1/loan/ltv/adjustment/history';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'orderId' => 'order_id',
        'loanCoin' => 'loan_coin',
        'collateralCoin' => 'collateral_coin',
        'startTime' => 'start_time',
        'endTime' => 'end_time',
        'current' => 'current',
        'limit' => 'limit',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}

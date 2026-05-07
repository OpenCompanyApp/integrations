<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Borrow - Get Flexible Loan Borrow History (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v2/loan/flexible/borrow/history.
 */
class BinanceGetSapiV2LoanFlexibleBorrowHistory extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v2_loan_flexible_borrow_history';
    protected const DESCRIPTION = 'Borrow - Get Flexible Loan Borrow History (USER_DATA)

- If startTime and endTime are not sent, the recent 90-day data will be returned. - The max interval between startTime and endTime is 180 days. Weight(IP): 400

Official Binance Spot endpoint: GET /sapi/v2/loan/flexible/borrow/history.';
    protected const PARAMETERS = [
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
            'description' => 'Default 500; max 1000.',
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
    protected const PATH = '/sapi/v2/loan/flexible/borrow/history';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
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

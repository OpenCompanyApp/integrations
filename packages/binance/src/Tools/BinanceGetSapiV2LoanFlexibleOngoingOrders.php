<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Borrow - Get Flexible Loan Ongoing Orders (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v2/loan/flexible/ongoing/orders.
 */
class BinanceGetSapiV2LoanFlexibleOngoingOrders extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v2_loan_flexible_ongoing_orders';
    protected const DESCRIPTION = 'Borrow - Get Flexible Loan Ongoing Orders (USER_DATA)

Weight(IP): 300

Official Binance Spot endpoint: GET /sapi/v2/loan/flexible/ongoing/orders.';
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
    protected const PATH = '/sapi/v2/loan/flexible/ongoing/orders';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'loanCoin' => 'loan_coin',
        'collateralCoin' => 'collateral_coin',
        'current' => 'current',
        'limit' => 'limit',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}

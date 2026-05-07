<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Get Loan Ongoing Orders (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/loan/ongoing/orders.
 */
class BinanceGetSapiV1LoanOngoingOrders extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_loan_ongoing_orders';
    protected const DESCRIPTION = 'Get Loan Ongoing Orders (USER_DATA)

Weight(IP): 300

Official Binance Spot endpoint: GET /sapi/v1/loan/ongoing/orders.';
    protected const PARAMETERS = [
        'order_id' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'orderId in POST /sapi/v1/loan/borrow',
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
        'current' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'Current querying page. Start from 1; default:1, max:1000',
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
    protected const PATH = '/sapi/v1/loan/ongoing/orders';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'orderId' => 'order_id',
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

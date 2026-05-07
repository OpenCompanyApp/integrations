<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Get VIP Loan Ongoing Orders (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/loan/vip/ongoing/orders.
 */
class BinanceGetSapiV1LoanVipOngoingOrders extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_loan_vip_ongoing_orders';
    protected const DESCRIPTION = 'Get VIP Loan Ongoing Orders (USER_DATA)

VIP loan is available for VIP users only. Weight(IP): 400

Official Binance Spot endpoint: GET /sapi/v1/loan/vip/ongoing/orders.';
    protected const PARAMETERS = [
        'order_id' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'Order id',
        ],
        'collateral_account_id' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'query parameter `collateralAccountId`.',
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
            'description' => 'Current querying page. Start from 1. Default:1',
        ],
        'limit' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'Default 10; max 100.',
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
    protected const PATH = '/sapi/v1/loan/vip/ongoing/orders';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'orderId' => 'order_id',
        'collateralAccountId' => 'collateral_account_id',
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

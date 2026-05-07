<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Crypto Loan Repay (TRADE).
 *
 * Maps to the official Binance Spot endpoint POST /sapi/v1/loan/repay.
 */
class BinancePostSapiV1LoanRepay extends AbstractBinanceTool
{
    protected const NAME = 'binance_post_sapi_v1_loan_repay';
    protected const DESCRIPTION = 'Crypto Loan Repay (TRADE)

Weight(UID): 6000

Official Binance Spot endpoint: POST /sapi/v1/loan/repay.';
    protected const PARAMETERS = [
        'order_id' => [
            'type' => 'integer',
            'required' => true,
            'description' => 'Order ID',
        ],
        'amount' => [
            'type' => 'number',
            'required' => true,
            'description' => 'Repayment Amount',
        ],
        'type' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'Default: 1. 1 for \'repay with borrowed coin\'; 2 for \'repay with collateral\'.',
        ],
        'collateral_return' => [
            'type' => 'boolean',
            'required' => false,
            'description' => 'Default: TRUE. TRUE: Return extra collateral to spot account; FALSE: Keep extra collateral in the order.',
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
    protected const METHOD = 'POST';
    protected const PATH = '/sapi/v1/loan/repay';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'orderId' => 'order_id',
        'amount' => 'amount',
        'type' => 'type',
        'collateralReturn' => 'collateral_return',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}

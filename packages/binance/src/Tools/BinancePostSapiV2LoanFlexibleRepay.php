<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Repay - Flexible Loan Repay (TRADE).
 *
 * Maps to the official Binance Spot endpoint POST /sapi/v2/loan/flexible/repay.
 */
class BinancePostSapiV2LoanFlexibleRepay extends AbstractBinanceTool
{
    protected const NAME = 'binance_post_sapi_v2_loan_flexible_repay';
    protected const DESCRIPTION = 'Repay - Flexible Loan Repay (TRADE)

- repayAmount is mandatory even fullRepayment = FALSE Weight(IP): 6000

Official Binance Spot endpoint: POST /sapi/v2/loan/flexible/repay.';
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
        'repay_amount' => [
            'type' => 'number',
            'required' => true,
            'description' => 'repay amount of loanCoin',
        ],
        'collateral_return' => [
            'type' => 'boolean',
            'required' => false,
            'description' => 'Default: TRUE. TRUE: Return extra collateral to earn account; FALSE: Keep extra collateral in the order, and lower LTV.',
        ],
        'full_repayment' => [
            'type' => 'boolean',
            'required' => false,
            'description' => 'Default: FALSE. TRUE: Full repayment; FALSE: Partial repayment, based on loanAmount',
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
    protected const PATH = '/sapi/v2/loan/flexible/repay';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'loanCoin' => 'loan_coin',
        'collateralCoin' => 'collateral_coin',
        'repayAmount' => 'repay_amount',
        'collateralReturn' => 'collateral_return',
        'fullRepayment' => 'full_repayment',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}

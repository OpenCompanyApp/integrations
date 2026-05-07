<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Borrow - Flexible Loan Borrow (TRADE).
 *
 * Maps to the official Binance Spot endpoint POST /sapi/v2/loan/flexible/borrow.
 */
class BinancePostSapiV2LoanFlexibleBorrow extends AbstractBinanceTool
{
    protected const NAME = 'binance_post_sapi_v2_loan_flexible_borrow';
    protected const DESCRIPTION = 'Borrow - Flexible Loan Borrow (TRADE)

- Only available for master account Weight(UID): 6000

Official Binance Spot endpoint: POST /sapi/v2/loan/flexible/borrow.';
    protected const PARAMETERS = [
        'loan_coin' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Coin loaned',
        ],
        'loan_amount' => [
            'type' => 'number',
            'required' => false,
            'description' => 'Loan amount',
        ],
        'collateral_coin' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Coin used as collateral',
        ],
        'collateral_amount' => [
            'type' => 'number',
            'required' => false,
            'description' => 'query parameter `collateralAmount`.',
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
    protected const PATH = '/sapi/v2/loan/flexible/borrow';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'loanCoin' => 'loan_coin',
        'loanAmount' => 'loan_amount',
        'collateralCoin' => 'collateral_coin',
        'collateralAmount' => 'collateral_amount',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}

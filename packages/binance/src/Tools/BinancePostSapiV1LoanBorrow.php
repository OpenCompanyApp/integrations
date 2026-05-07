<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Crypto Loan Borrow (TRADE).
 *
 * Maps to the official Binance Spot endpoint POST /sapi/v1/loan/borrow.
 */
class BinancePostSapiV1LoanBorrow extends AbstractBinanceTool
{
    protected const NAME = 'binance_post_sapi_v1_loan_borrow';
    protected const DESCRIPTION = 'Crypto Loan Borrow (TRADE)

Weight(UID): 6000

Official Binance Spot endpoint: POST /sapi/v1/loan/borrow.';
    protected const PARAMETERS = [
        'loan_coin' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Coin loaned',
        ],
        'loan_amount' => [
            'type' => 'number',
            'required' => false,
            'description' => 'Loan amount',
        ],
        'collateral_coin' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Coin used as collateral',
        ],
        'collateral_amount' => [
            'type' => 'number',
            'required' => false,
            'description' => 'query parameter `collateralAmount`.',
        ],
        'loan_term' => [
            'type' => 'integer',
            'required' => true,
            'description' => '7/14/30/90/180 days',
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
    protected const PATH = '/sapi/v1/loan/borrow';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'loanCoin' => 'loan_coin',
        'loanAmount' => 'loan_amount',
        'collateralCoin' => 'collateral_coin',
        'collateralAmount' => 'collateral_amount',
        'loanTerm' => 'loan_term',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}

<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * VIP Loan Borrow.
 *
 * Maps to the official Binance Spot endpoint POST /sapi/v1/loan/vip/borrow.
 */
class BinancePostSapiV1LoanVipBorrow extends AbstractBinanceTool
{
    protected const NAME = 'binance_post_sapi_v1_loan_vip_borrow';
    protected const DESCRIPTION = 'VIP Loan Borrow

VIP loan is available for VIP users only. Weight(UID): 6000

Official Binance Spot endpoint: POST /sapi/v1/loan/vip/borrow.';
    protected const PARAMETERS = [
        'loan_account_id' => [
            'type' => 'integer',
            'required' => true,
            'description' => 'query parameter `loanAccountId`.',
        ],
        'loan_coin' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Coin loaned',
        ],
        'loan_amount' => [
            'type' => 'number',
            'required' => true,
            'description' => 'query parameter `loanAmount`.',
        ],
        'collateral_account_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'query parameter `collateralAccountId`.',
        ],
        'collateral_coin' => [
            'type' => 'string',
            'required' => true,
            'description' => 'query parameter `collateralCoin`.',
        ],
        'is_flexible_rate' => [
            'type' => 'string',
            'required' => true,
            'description' => 'query parameter `isFlexibleRate`.',
            'enum' => [
                'TRUE',
                'FALSE',
            ],
        ],
        'loan_term' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'query parameter `loanTerm`.',
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
    protected const PATH = '/sapi/v1/loan/vip/borrow';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'loanAccountId' => 'loan_account_id',
        'loanCoin' => 'loan_coin',
        'loanAmount' => 'loan_amount',
        'collateralAccountId' => 'collateral_account_id',
        'collateralCoin' => 'collateral_coin',
        'isFlexibleRate' => 'is_flexible_rate',
        'loanTerm' => 'loan_term',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}

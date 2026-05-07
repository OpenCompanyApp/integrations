<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Adjust LTV - Flexible Loan Adjust LTV (TRADE).
 *
 * Maps to the official Binance Spot endpoint POST /sapi/v2/loan/flexible/adjust/ltv.
 */
class BinancePostSapiV2LoanFlexibleAdjustLtv extends AbstractBinanceTool
{
    protected const NAME = 'binance_post_sapi_v2_loan_flexible_adjust_ltv';
    protected const DESCRIPTION = 'Adjust LTV - Flexible Loan Adjust LTV (TRADE)

- API Key needs Spot & Margin Trading permission for this endpoint Weight(UID): 6000

Official Binance Spot endpoint: POST /sapi/v2/loan/flexible/adjust/ltv.';
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
        'adjustment_amount' => [
            'type' => 'number',
            'required' => true,
            'description' => 'query parameter `adjustmentAmount`.',
        ],
        'direction' => [
            'type' => 'string',
            'required' => true,
            'description' => 'query parameter `direction`.',
            'enum' => [
                'ADDITIONAL',
                'REDUCED',
            ],
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
    protected const PATH = '/sapi/v2/loan/flexible/adjust/ltv';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'loanCoin' => 'loan_coin',
        'collateralCoin' => 'collateral_coin',
        'adjustmentAmount' => 'adjustment_amount',
        'direction' => 'direction',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}

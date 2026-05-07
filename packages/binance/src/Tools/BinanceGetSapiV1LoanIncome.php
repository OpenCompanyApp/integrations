<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Get Crypto Loans Income History (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/loan/income.
 */
class BinanceGetSapiV1LoanIncome extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_loan_income';
    protected const DESCRIPTION = 'Get Crypto Loans Income History (USER_DATA)

- If startTime and endTime are not sent, the recent 7-day data will be returned. - The max interval between startTime and endTime is 30 days. Weight(UID): 6000

Official Binance Spot endpoint: GET /sapi/v1/loan/income.';
    protected const PARAMETERS = [
        'asset' => [
            'type' => 'string',
            'required' => false,
            'description' => 'query parameter `asset`.',
        ],
        'type' => [
            'type' => 'string',
            'required' => false,
            'description' => 'All types will be returned by default. * `borrowIn` * `collateralSpent` * `repayAmount` * `collateralReturn` - Collateral return after repayment * `addCollateral` * `removeCollateral` * `collateralReturnAfterLiquidation`',
            'enum' => [
                'borrowIn',
                'collateralSpent',
                'repayAmount',
                'collateralReturn',
                'addCollateral',
                'removeCollateral',
                'collateralReturnAfterLiquidation',
            ],
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
        'limit' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'default 20, max 100',
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
    protected const PATH = '/sapi/v1/loan/income';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'asset' => 'asset',
        'type' => 'type',
        'startTime' => 'start_time',
        'endTime' => 'end_time',
        'limit' => 'limit',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}

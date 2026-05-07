<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Get Loanable Assets Data (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/loan/loanable/data.
 */
class BinanceGetSapiV1LoanLoanableData extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_loan_loanable_data';
    protected const DESCRIPTION = 'Get Loanable Assets Data (USER_DATA)

Get interest rate and borrow limit of loanable assets. The borrow limit is shown in USD value. Weight(IP): 400

Official Binance Spot endpoint: GET /sapi/v1/loan/loanable/data.';
    protected const PARAMETERS = [
        'loan_coin' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Coin loaned',
        ],
        'vip_level' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'Defaults to user\'s vip level',
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
    protected const PATH = '/sapi/v1/loan/loanable/data';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'loanCoin' => 'loan_coin',
        'vipLevel' => 'vip_level',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}

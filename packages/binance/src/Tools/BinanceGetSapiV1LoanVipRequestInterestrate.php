<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Get Borrow Interest Rate (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/loan/vip/request/interestRate.
 */
class BinanceGetSapiV1LoanVipRequestInterestrate extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_loan_vip_request_interestrate';
    protected const DESCRIPTION = 'Get Borrow Interest Rate (USER_DATA)

Get borrow interest rate. Weight(UID): 400

Official Binance Spot endpoint: GET /sapi/v1/loan/vip/request/interestRate.';
    protected const PARAMETERS = [
        'loan_coin' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Max 10 assets, Multiple split by ","',
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
    protected const PATH = '/sapi/v1/loan/vip/request/interestRate';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'loanCoin' => 'loan_coin',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}

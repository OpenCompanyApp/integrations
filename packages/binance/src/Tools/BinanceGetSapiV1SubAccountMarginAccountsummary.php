<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Summary of Sub-account's Margin Account (For Master Account).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/sub-account/margin/accountSummary.
 */
class BinanceGetSapiV1SubAccountMarginAccountsummary extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_sub_account_margin_accountsummary';
    protected const DESCRIPTION = 'Summary of Sub-account\'s Margin Account (For Master Account)

Weight(IP): 10

Official Binance Spot endpoint: GET /sapi/v1/sub-account/margin/accountSummary.';
    protected const PARAMETERS = [
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
    protected const PATH = '/sapi/v1/sub-account/margin/accountSummary';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}

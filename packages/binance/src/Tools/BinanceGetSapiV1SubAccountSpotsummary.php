<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Sub-account Spot Assets Summary (For Master Account).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/sub-account/spotSummary.
 */
class BinanceGetSapiV1SubAccountSpotsummary extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_sub_account_spotsummary';
    protected const DESCRIPTION = 'Sub-account Spot Assets Summary (For Master Account)

Get BTC valued asset summary of subaccounts. Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/sub-account/spotSummary.';
    protected const PARAMETERS = [
        'email' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Sub-account email',
        ],
        'page' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'Default 1',
        ],
        'size' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'Default:10 Max:20',
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
    protected const PATH = '/sapi/v1/sub-account/spotSummary';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'email' => 'email',
        'page' => 'page',
        'size' => 'size',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}

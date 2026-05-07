<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Sub-account's Status on Margin/Futures (For Master Account).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/sub-account/status.
 */
class BinanceGetSapiV1SubAccountStatus extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_sub_account_status';
    protected const DESCRIPTION = 'Sub-account\'s Status on Margin/Futures (For Master Account)

- If no `email` sent, all sub-accounts\' information will be returned. Weight(IP): 10

Official Binance Spot endpoint: GET /sapi/v1/sub-account/status.';
    protected const PARAMETERS = [
        'email' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Sub-account email',
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
    protected const PATH = '/sapi/v1/sub-account/status';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'email' => 'email',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}

<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Disable Fast Withdraw Switch (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint POST /sapi/v1/account/disableFastWithdrawSwitch.
 */
class BinancePostSapiV1AccountDisablefastwithdrawswitch extends AbstractBinanceTool
{
    protected const NAME = 'binance_post_sapi_v1_account_disablefastwithdrawswitch';
    protected const DESCRIPTION = 'Disable Fast Withdraw Switch (USER_DATA)

- This request will disable fastwithdraw switch under your account. - You need to enable "trade" option for the api key which requests this endpoint. Weight(IP): 1

Official Binance Spot endpoint: POST /sapi/v1/account/disableFastWithdrawSwitch.';
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
    protected const METHOD = 'POST';
    protected const PATH = '/sapi/v1/account/disableFastWithdrawSwitch';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}

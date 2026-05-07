<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Enable Fast Withdraw Switch (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint POST /sapi/v1/account/enableFastWithdrawSwitch.
 */
class BinancePostSapiV1AccountEnablefastwithdrawswitch extends AbstractBinanceTool
{
    protected const NAME = 'binance_post_sapi_v1_account_enablefastwithdrawswitch';
    protected const DESCRIPTION = 'Enable Fast Withdraw Switch (USER_DATA)

- This request will enable fastwithdraw switch under your account. You need to enable "trade" option for the api key which requests this endpoint. - When Fast Withdraw Switch is on, transferring funds to a Binance account will be done instantly. There is no on-chain transaction, no transaction ID and no withdrawal fee. Weight(IP): 1

Official Binance Spot endpoint: POST /sapi/v1/account/enableFastWithdrawSwitch.';
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
    protected const PATH = '/sapi/v1/account/enableFastWithdrawSwitch';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}

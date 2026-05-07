<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Create a Virtual Sub-account(For Master Account).
 *
 * Maps to the official Binance Spot endpoint POST /sapi/v1/sub-account/virtualSubAccount.
 */
class BinancePostSapiV1SubAccountVirtualsubaccount extends AbstractBinanceTool
{
    protected const NAME = 'binance_post_sapi_v1_sub_account_virtualsubaccount';
    protected const DESCRIPTION = 'Create a Virtual Sub-account(For Master Account)

- This request will generate a virtual sub account under your master account. - You need to enable "trade" option for the api key which requests this endpoint. Weight(IP): 1

Official Binance Spot endpoint: POST /sapi/v1/sub-account/virtualSubAccount.';
    protected const PARAMETERS = [
        'sub_account_string' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Please input a string. We will create a virtual email using that string for you to register',
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
    protected const PATH = '/sapi/v1/sub-account/virtualSubAccount';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'subAccountString' => 'sub_account_string',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}

<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Enable Options for Sub-account (For Master Account)(USER_DATA).
 *
 * Maps to the official Binance Spot endpoint POST /sapi/v1/sub-account/eoptions/enable.
 */
class BinancePostSapiV1SubAccountEoptionsEnable extends AbstractBinanceTool
{
    protected const NAME = 'binance_post_sapi_v1_sub_account_eoptions_enable';
    protected const DESCRIPTION = 'Enable Options for Sub-account (For Master Account)(USER_DATA)

Enable Options for Sub-account (For Master Account). Weight(IP): 1

Official Binance Spot endpoint: POST /sapi/v1/sub-account/eoptions/enable.';
    protected const PARAMETERS = [
        'email' => [
            'type' => 'string',
            'required' => true,
            'description' => 'query parameter `email`.',
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
    protected const PATH = '/sapi/v1/sub-account/eoptions/enable';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'email' => 'email',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}

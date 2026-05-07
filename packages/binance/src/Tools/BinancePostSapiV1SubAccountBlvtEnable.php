<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Enable Leverage Token for Sub-account (For Master Account).
 *
 * Maps to the official Binance Spot endpoint POST /sapi/v1/sub-account/blvt/enable.
 */
class BinancePostSapiV1SubAccountBlvtEnable extends AbstractBinanceTool
{
    protected const NAME = 'binance_post_sapi_v1_sub_account_blvt_enable';
    protected const DESCRIPTION = 'Enable Leverage Token for Sub-account (For Master Account)

Weight(IP): 1

Official Binance Spot endpoint: POST /sapi/v1/sub-account/blvt/enable.';
    protected const PARAMETERS = [
        'email' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Sub-account email',
        ],
        'enable_blvt' => [
            'type' => 'boolean',
            'required' => true,
            'description' => 'Only true for now',
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
    protected const PATH = '/sapi/v1/sub-account/blvt/enable';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'email' => 'email',
        'enableBlvt' => 'enable_blvt',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}

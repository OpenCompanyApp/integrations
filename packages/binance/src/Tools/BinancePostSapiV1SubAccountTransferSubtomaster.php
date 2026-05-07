<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Transfer to Master (For Sub-account).
 *
 * Maps to the official Binance Spot endpoint POST /sapi/v1/sub-account/transfer/subToMaster.
 */
class BinancePostSapiV1SubAccountTransferSubtomaster extends AbstractBinanceTool
{
    protected const NAME = 'binance_post_sapi_v1_sub_account_transfer_subtomaster';
    protected const DESCRIPTION = 'Transfer to Master (For Sub-account)

Weight(IP): 1

Official Binance Spot endpoint: POST /sapi/v1/sub-account/transfer/subToMaster.';
    protected const PARAMETERS = [
        'asset' => [
            'type' => 'string',
            'required' => true,
            'description' => 'query parameter `asset`.',
        ],
        'amount' => [
            'type' => 'number',
            'required' => true,
            'description' => 'query parameter `amount`.',
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
    protected const PATH = '/sapi/v1/sub-account/transfer/subToMaster';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'asset' => 'asset',
        'amount' => 'amount',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}

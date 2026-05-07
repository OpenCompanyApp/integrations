<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Get IP Restriction for a Sub-account API Key (For Master Account).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/sub-account/subAccountApi/ipRestriction.
 */
class BinanceGetSapiV1SubAccountSubaccountapiIprestriction extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_sub_account_subaccountapi_iprestriction';
    protected const DESCRIPTION = 'Get IP Restriction for a Sub-account API Key (For Master Account)

Weight(UID): 3000

Official Binance Spot endpoint: GET /sapi/v1/sub-account/subAccountApi/ipRestriction.';
    protected const PARAMETERS = [
        'email' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Sub-account email',
        ],
        'sub_account_api_key' => [
            'type' => 'string',
            'required' => true,
            'description' => 'query parameter `subAccountApiKey`.',
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
    protected const PATH = '/sapi/v1/sub-account/subAccountApi/ipRestriction';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'email' => 'email',
        'subAccountApiKey' => 'sub_account_api_key',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}

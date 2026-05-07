<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Delete IP List for a Sub-account API Key (For Master Account).
 *
 * Maps to the official Binance Spot endpoint DELETE /sapi/v1/sub-account/subAccountApi/ipRestriction/ipList.
 */
class BinanceDeleteSapiV1SubAccountSubaccountapiIprestrictionIplist extends AbstractBinanceTool
{
    protected const NAME = 'binance_delete_sapi_v1_sub_account_subaccountapi_iprestriction_iplist';
    protected const DESCRIPTION = 'Delete IP List for a Sub-account API Key (For Master Account)

Weight(UID): 3000

Official Binance Spot endpoint: DELETE /sapi/v1/sub-account/subAccountApi/ipRestriction/ipList.';
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
        'ip_address' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Can be added in batches, separated by commas',
        ],
        'third_party_name' => [
            'type' => 'string',
            'required' => false,
            'description' => 'third party IP list name',
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
    protected const METHOD = 'DELETE';
    protected const PATH = '/sapi/v1/sub-account/subAccountApi/ipRestriction/ipList';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'email' => 'email',
        'subAccountApiKey' => 'sub_account_api_key',
        'ipAddress' => 'ip_address',
        'thirdPartyName' => 'third_party_name',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}

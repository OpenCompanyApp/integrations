<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Update IP Restriction for Sub-Account API key (For Master Account).
 *
 * Maps to the official Binance Spot endpoint POST /sapi/v2/sub-account/subAccountApi/ipRestriction.
 */
class BinancePostSapiV2SubAccountSubaccountapiIprestriction extends AbstractBinanceTool
{
    protected const NAME = 'binance_post_sapi_v2_sub_account_subaccountapi_iprestriction';
    protected const DESCRIPTION = 'Update IP Restriction for Sub-Account API key (For Master Account)

Update IP Restriction for Sub-Account API key Weight(UID): 3000

Official Binance Spot endpoint: POST /sapi/v2/sub-account/subAccountApi/ipRestriction.';
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
        'status' => [
            'type' => 'string',
            'required' => true,
            'description' => 'IP Restriction status. 1 = IP Unrestricted. 2 = Restrict access to trusted IPs only. 3 = Restrict access to users\' trusted third party IPs only',
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
    protected const METHOD = 'POST';
    protected const PATH = '/sapi/v2/sub-account/subAccountApi/ipRestriction';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'email' => 'email',
        'subAccountApiKey' => 'sub_account_api_key',
        'status' => 'status',
        'thirdPartyName' => 'third_party_name',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}

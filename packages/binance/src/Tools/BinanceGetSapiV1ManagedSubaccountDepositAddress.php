<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Get Managed Sub-account Deposit Address (For Investor Master Account).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/managed-subaccount/deposit/address.
 */
class BinanceGetSapiV1ManagedSubaccountDepositAddress extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_managed_subaccount_deposit_address';
    protected const DESCRIPTION = 'Get Managed Sub-account Deposit Address (For Investor Master Account)

Get investor\'s managed sub-account deposit address Weight(UID): 1

Official Binance Spot endpoint: GET /sapi/v1/managed-subaccount/deposit/address.';
    protected const PARAMETERS = [
        'email' => [
            'type' => 'string',
            'required' => true,
            'description' => 'query parameter `email`.',
        ],
        'coin' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Coin name',
        ],
        'network' => [
            'type' => 'string',
            'required' => false,
            'description' => 'query parameter `network`.',
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
    protected const PATH = '/sapi/v1/managed-subaccount/deposit/address';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'email' => 'email',
        'coin' => 'coin',
        'network' => 'network',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}

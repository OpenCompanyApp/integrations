<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Deposit assets into the managed sub-account(For Investor Master Account).
 *
 * Maps to the official Binance Spot endpoint POST /sapi/v1/managed-subaccount/deposit.
 */
class BinancePostSapiV1ManagedSubaccountDeposit extends AbstractBinanceTool
{
    protected const NAME = 'binance_post_sapi_v1_managed_subaccount_deposit';
    protected const DESCRIPTION = 'Deposit assets into the managed sub-account(For Investor Master Account)

Weight(IP): 1

Official Binance Spot endpoint: POST /sapi/v1/managed-subaccount/deposit.';
    protected const PARAMETERS = [
        'to_email' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Recipient email',
        ],
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
    protected const PATH = '/sapi/v1/managed-subaccount/deposit';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'toEmail' => 'to_email',
        'asset' => 'asset',
        'amount' => 'amount',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}

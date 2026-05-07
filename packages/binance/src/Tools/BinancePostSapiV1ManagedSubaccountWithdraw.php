<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Withdrawl assets from the managed sub-account(For Investor Master Account).
 *
 * Maps to the official Binance Spot endpoint POST /sapi/v1/managed-subaccount/withdraw.
 */
class BinancePostSapiV1ManagedSubaccountWithdraw extends AbstractBinanceTool
{
    protected const NAME = 'binance_post_sapi_v1_managed_subaccount_withdraw';
    protected const DESCRIPTION = 'Withdrawl assets from the managed sub-account(For Investor Master Account)

Weight(IP): 1

Official Binance Spot endpoint: POST /sapi/v1/managed-subaccount/withdraw.';
    protected const PARAMETERS = [
        'from_email' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Sender email',
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
        'transfer_date' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'Withdrawals is automatically occur on the transfer date(UTC0). If a date is not selected, the withdrawal occurs right now',
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
    protected const PATH = '/sapi/v1/managed-subaccount/withdraw';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'fromEmail' => 'from_email',
        'asset' => 'asset',
        'amount' => 'amount',
        'transferDate' => 'transfer_date',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}

<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Margin Transfer for Sub-account (For Master Account).
 *
 * Maps to the official Binance Spot endpoint POST /sapi/v1/sub-account/margin/transfer.
 */
class BinancePostSapiV1SubAccountMarginTransfer extends AbstractBinanceTool
{
    protected const NAME = 'binance_post_sapi_v1_sub_account_margin_transfer';
    protected const DESCRIPTION = 'Margin Transfer for Sub-account (For Master Account)

Weight(IP): 1

Official Binance Spot endpoint: POST /sapi/v1/sub-account/margin/transfer.';
    protected const PARAMETERS = [
        'email' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Sub-account email',
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
        'type' => [
            'type' => 'integer',
            'required' => true,
            'description' => '* `1` - transfer from subaccount\'s spot account to margin account * `2` - transfer from subaccount\'s margin account to its spot account',
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
    protected const PATH = '/sapi/v1/sub-account/margin/transfer';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'email' => 'email',
        'asset' => 'asset',
        'amount' => 'amount',
        'type' => 'type',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}

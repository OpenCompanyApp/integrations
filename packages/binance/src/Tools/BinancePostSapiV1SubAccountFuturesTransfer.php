<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Transfer for Sub-account (For Master Account).
 *
 * Maps to the official Binance Spot endpoint POST /sapi/v1/sub-account/futures/transfer.
 */
class BinancePostSapiV1SubAccountFuturesTransfer extends AbstractBinanceTool
{
    protected const NAME = 'binance_post_sapi_v1_sub_account_futures_transfer';
    protected const DESCRIPTION = 'Transfer for Sub-account (For Master Account)

Weight(IP): 1

Official Binance Spot endpoint: POST /sapi/v1/sub-account/futures/transfer.';
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
            'description' => '* `1` - transfer from subaccount\'s spot account to its USDT-margined futures account * `2` - transfer from subaccount\'s USDT-margined futures account to its spot account * `3` - transfer from subaccount\'s spot account to its COIN-margined futures account * `4` - transfer from subaccount\'s COIN-margined futures account to its spot account',
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
    protected const PATH = '/sapi/v1/sub-account/futures/transfer';
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

<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Sub-account Futures Asset Transfer (For Master Account).
 *
 * Maps to the official Binance Spot endpoint POST /sapi/v1/sub-account/futures/internalTransfer.
 */
class BinancePostSapiV1SubAccountFuturesInternaltransfer extends AbstractBinanceTool
{
    protected const NAME = 'binance_post_sapi_v1_sub_account_futures_internaltransfer';
    protected const DESCRIPTION = 'Sub-account Futures Asset Transfer (For Master Account)

- Master account can transfer max 2000 times a minute Weight(IP): 1

Official Binance Spot endpoint: POST /sapi/v1/sub-account/futures/internalTransfer.';
    protected const PARAMETERS = [
        'from_email' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Sender email',
        ],
        'to_email' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Recipient email',
        ],
        'futures_type' => [
            'type' => 'integer',
            'required' => true,
            'description' => '1:USDT-margined Futures,2: Coin-margined Futures',
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
    protected const PATH = '/sapi/v1/sub-account/futures/internalTransfer';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'fromEmail' => 'from_email',
        'toEmail' => 'to_email',
        'futuresType' => 'futures_type',
        'asset' => 'asset',
        'amount' => 'amount',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}

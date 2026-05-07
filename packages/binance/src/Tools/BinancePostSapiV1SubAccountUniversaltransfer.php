<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Universal Transfer (For Master Account).
 *
 * Maps to the official Binance Spot endpoint POST /sapi/v1/sub-account/universalTransfer.
 */
class BinancePostSapiV1SubAccountUniversaltransfer extends AbstractBinanceTool
{
    protected const NAME = 'binance_post_sapi_v1_sub_account_universaltransfer';
    protected const DESCRIPTION = 'Universal Transfer (For Master Account)

- You need to enable "internal transfer" option for the api key which requests this endpoint. - Transfer from master account by default if fromEmail is not sent. - Transfer to master account by default if toEmail is not sent. - Supported transfer scenarios: - Master account SPOT transfer to sub-account SPOT,USDT_FUTURE,COIN_FUTURE,MARGIN(Cross),ISOLATED_MARGIN - Sub-account SPOT,USDT_FUTURE,COIN_FUTURE,MARGIN(Cross),ISOLATED_MARGIN transfer to master account SPOT - Transfer between two sub-account SPOT accounts Weight(IP): 1

Official Binance Spot endpoint: POST /sapi/v1/sub-account/universalTransfer.';
    protected const PARAMETERS = [
        'from_email' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Sub-account email',
        ],
        'to_email' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Sub-account email',
        ],
        'from_account_type' => [
            'type' => 'string',
            'required' => true,
            'description' => 'query parameter `fromAccountType`.',
            'enum' => [
                'SPOT',
                'USDT_FUTURE',
                'COIN_FUTURE',
                'MARGIN',
                'ISOLATED_MARGIN',
            ],
        ],
        'to_account_type' => [
            'type' => 'string',
            'required' => true,
            'description' => 'query parameter `toAccountType`.',
            'enum' => [
                'SPOT',
                'USDT_FUTURE',
                'COIN_FUTURE',
                'MARGIN',
                'ISOLATED_MARGIN',
            ],
        ],
        'client_tran_id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'query parameter `clientTranId`.',
        ],
        'symbol' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Only supported under ISOLATED_MARGIN type',
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
    protected const PATH = '/sapi/v1/sub-account/universalTransfer';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'fromEmail' => 'from_email',
        'toEmail' => 'to_email',
        'fromAccountType' => 'from_account_type',
        'toAccountType' => 'to_account_type',
        'clientTranId' => 'client_tran_id',
        'symbol' => 'symbol',
        'asset' => 'asset',
        'amount' => 'amount',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}

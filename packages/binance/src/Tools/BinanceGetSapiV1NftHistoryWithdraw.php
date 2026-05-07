<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Get NFT Withdraw History (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/nft/history/withdraw.
 */
class BinanceGetSapiV1NftHistoryWithdraw extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_nft_history_withdraw';
    protected const DESCRIPTION = 'Get NFT Withdraw History (USER_DATA)

- The max interval between startTime and endTime is 90 days. - If startTime and endTime are not sent, the recent 7 days\' data will be returned. Weight(UID): 3000

Official Binance Spot endpoint: GET /sapi/v1/nft/history/withdraw.';
    protected const PARAMETERS = [
        'start_time' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'UTC timestamp in ms',
        ],
        'end_time' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'UTC timestamp in ms',
        ],
        'limit' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'Default 50, Max 50',
        ],
        'page' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'Default 1',
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
    protected const PATH = '/sapi/v1/nft/history/withdraw';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'startTime' => 'start_time',
        'endTime' => 'end_time',
        'limit' => 'limit',
        'page' => 'page',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}

<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Query User Delegation History(For Master Account) (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/asset/custody/transfer-history.
 */
class BinanceGetSapiV1AssetCustodyTransferHistory extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_asset_custody_transfer_history';
    protected const DESCRIPTION = 'Query User Delegation History(For Master Account) (USER_DATA)

Query User Delegation History Weight(IP): 60

Official Binance Spot endpoint: GET /sapi/v1/asset/custody/transfer-history.';
    protected const PARAMETERS = [
        'email' => [
            'type' => 'string',
            'required' => true,
            'description' => 'query parameter `email`.',
        ],
        'start_time' => [
            'type' => 'integer',
            'required' => true,
            'description' => 'query parameter `startTime`.',
        ],
        'end_time' => [
            'type' => 'integer',
            'required' => true,
            'description' => 'query parameter `endTime`.',
        ],
        'type' => [
            'type' => 'string',
            'required' => false,
            'description' => 'query parameter `type`.',
        ],
        'asset' => [
            'type' => 'string',
            'required' => true,
            'description' => 'query parameter `asset`.',
        ],
        'current' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'Current querying page. Start from 1. Default:1',
        ],
        'size' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'Default:10 Max:100',
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
    protected const PATH = '/sapi/v1/asset/custody/transfer-history';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'email' => 'email',
        'startTime' => 'start_time',
        'endTime' => 'end_time',
        'type' => 'type',
        'asset' => 'asset',
        'current' => 'current',
        'size' => 'size',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}

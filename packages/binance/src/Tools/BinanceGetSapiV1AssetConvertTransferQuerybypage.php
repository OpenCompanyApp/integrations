<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Query Convert Transfer (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/asset/convert-transfer/queryByPage.
 */
class BinanceGetSapiV1AssetConvertTransferQuerybypage extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_asset_convert_transfer_querybypage';
    protected const DESCRIPTION = 'Query Convert Transfer (USER_DATA)

Weight(UID): 5

Official Binance Spot endpoint: GET /sapi/v1/asset/convert-transfer/queryByPage.';
    protected const PARAMETERS = [
        'tran_id' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'The transaction id',
        ],
        'asset' => [
            'type' => 'string',
            'required' => false,
            'description' => 'If it is blank, we will match deducted asset and target asset.',
        ],
        'start_time' => [
            'type' => 'integer',
            'required' => true,
            'description' => 'UTC timestamp in ms',
        ],
        'end_time' => [
            'type' => 'integer',
            'required' => true,
            'description' => 'UTC timestamp in ms',
        ],
        'account_type' => [
            'type' => 'string',
            'required' => false,
            'description' => 'MAIN: main account. CARD: funding account. If it is blank, we will query spot and card wallet, otherwise, we just query the corresponding wallet',
            'enum' => [
                'MAIN',
                'CARD',
            ],
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
    protected const PATH = '/sapi/v1/asset/convert-transfer/queryByPage';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'tranId' => 'tran_id',
        'asset' => 'asset',
        'startTime' => 'start_time',
        'endTime' => 'end_time',
        'accountType' => 'account_type',
        'current' => 'current',
        'size' => 'size',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}

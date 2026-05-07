<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Convert Transfer (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint POST /sapi/v1/asset/convert-transfer.
 */
class BinancePostSapiV1AssetConvertTransfer extends AbstractBinanceTool
{
    protected const NAME = 'binance_post_sapi_v1_asset_convert_transfer';
    protected const DESCRIPTION = 'Convert Transfer (USER_DATA)

Convert transfer, convert between BUSD and stablecoins. If the clientId has been used before, will not do the convert transfer, the original transfer will be returned. Weight(UID): 5

Official Binance Spot endpoint: POST /sapi/v1/asset/convert-transfer.';
    protected const PARAMETERS = [
        'client_tran_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The unique flag, the min length is 20',
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
        'target_asset' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Target asset you want to convert',
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
    protected const PATH = '/sapi/v1/asset/convert-transfer';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'clientTranId' => 'client_tran_id',
        'asset' => 'asset',
        'amount' => 'amount',
        'targetAsset' => 'target_asset',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}

<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * User Universal Transfer (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint POST /sapi/v1/asset/transfer.
 */
class BinancePostSapiV1AssetTransfer extends AbstractBinanceTool
{
    protected const NAME = 'binance_post_sapi_v1_asset_transfer';
    protected const DESCRIPTION = 'User Universal Transfer (USER_DATA)

You need to enable `Permits Universal Transfer` option for the api key which requests this endpoint. - `fromSymbol` must be sent when type are ISOLATEDMARGIN_MARGIN and ISOLATEDMARGIN_ISOLATEDMARGIN - `toSymbol` must be sent when type are MARGIN_ISOLATEDMARGIN and ISOLATEDMARGIN_ISOLATEDMARGIN ENUM of transfer types: - MAIN_UMFUTURE Spot account transfer to USDⓈ-M Futures account - MAIN_CMFUTURE Spot account transfer to COIN-M Futures account - MAIN_MARGIN Spot account transfer to Margin(cross)account - UMFUTURE_MAIN USDⓈ-M Futures account transfer to Spot account - UMFUTURE_MARGIN USDⓈ-M Futures account transfer to Margin(cross)account - CMFUTURE_MAIN COIN-M Futures account transfer to Spot account - CMFUTURE_MARGIN COIN-M Futures account transfer to Margin(cross) account - MARGIN_MAIN Margin(cross)account transfer to Spot account - MARGIN_UMFUTURE Margin(cross)account transfer to USDⓈ-M Futures - MARGIN_CMFUTURE Margin(cross)account transfer to COIN-M Futures - ISOLATEDMARGIN_MARGIN

Official Binance Spot endpoint: POST /sapi/v1/asset/transfer.';
    protected const PARAMETERS = [
        'type' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Universal transfer type',
            'enum' => [
                'MAIN_C2C',
                'MAIN_UMFUTURE',
                'MAIN_CMFUTURE',
                'MAIN_MARGIN',
                'MAIN_MINING',
                'C2C_MAIN',
                'C2C_UMFUTURE',
                'C2C_MINING',
                'C2C_MARGIN',
                'UMFUTURE_MAIN',
                'UMFUTURE_C2C',
                'UMFUTURE_MARGIN',
                'CMFUTURE_MAIN',
                'CMFUTURE_MARGIN',
                'MARGIN_MAIN',
                'MARGIN_UMFUTURE',
                'MARGIN_CMFUTURE',
                'MARGIN_MINING',
                'MARGIN_C2C',
                'MINING_MAIN',
                'MINING_UMFUTURE',
                'MINING_C2C',
                'MINING_MARGIN',
                'MAIN_PAY',
                'PAY_MAIN',
                'ISOLATEDMARGIN_MARGIN',
                'MARGIN_ISOLATEDMARGIN',
                'ISOLATEDMARGIN_ISOLATEDMARGIN',
            ],
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
        'from_symbol' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Must be sent when type are ISOLATEDMARGIN_MARGIN and ISOLATEDMARGIN_ISOLATEDMARGIN',
        ],
        'to_symbol' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Must be sent when type are MARGIN_ISOLATEDMARGIN and ISOLATEDMARGIN_ISOLATEDMARGIN',
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
    protected const PATH = '/sapi/v1/asset/transfer';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'type' => 'type',
        'asset' => 'asset',
        'amount' => 'amount',
        'fromSymbol' => 'from_symbol',
        'toSymbol' => 'to_symbol',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}

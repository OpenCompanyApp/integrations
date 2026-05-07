<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Get Cloud-Mining payment and refund history (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/asset/ledger-transfer/cloud-mining/queryByPage.
 */
class BinanceGetSapiV1AssetLedgerTransferCloudMiningQuerybypage extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_asset_ledger_transfer_cloud_mining_querybypage';
    protected const DESCRIPTION = 'Get Cloud-Mining payment and refund history (USER_DATA)

The query of Cloud-Mining payment and refund history Weight(UID): 600

Official Binance Spot endpoint: GET /sapi/v1/asset/ledger-transfer/cloud-mining/queryByPage.';
    protected const PARAMETERS = [
        'tran_id' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'The transaction id',
        ],
        'client_tran_id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'The unique flag',
        ],
        'asset' => [
            'type' => 'string',
            'required' => false,
            'description' => 'If it is blank, we will query all assets',
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
    protected const PATH = '/sapi/v1/asset/ledger-transfer/cloud-mining/queryByPage';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'tranId' => 'tran_id',
        'clientTranId' => 'client_tran_id',
        'asset' => 'asset',
        'startTime' => 'start_time',
        'endTime' => 'end_time',
        'current' => 'current',
        'size' => 'size',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}

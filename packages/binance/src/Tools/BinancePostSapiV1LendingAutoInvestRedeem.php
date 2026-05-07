<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Index Linked Plan Redemption (TRADE).
 *
 * Maps to the official Binance Spot endpoint POST /sapi/v1/lending/auto-invest/redeem.
 */
class BinancePostSapiV1LendingAutoInvestRedeem extends AbstractBinanceTool
{
    protected const NAME = 'binance_post_sapi_v1_lending_auto_invest_redeem';
    protected const DESCRIPTION = 'Index Linked Plan Redemption (TRADE)

To redeem index-Linked plan holdings Weight(IP): 1

Official Binance Spot endpoint: POST /sapi/v1/lending/auto-invest/redeem.';
    protected const PARAMETERS = [
        'index_id' => [
            'type' => 'integer',
            'required' => true,
            'description' => 'PORTFOLIO plan\'s Id',
        ],
        'request_id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'sourceType + unique, transactionId and requestId cannot be empty at the same time',
        ],
        'redemption_percentage' => [
            'type' => 'integer',
            'required' => true,
            'description' => 'user redeem percentage,10/20/100.',
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
    protected const PATH = '/sapi/v1/lending/auto-invest/redeem';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'indexId' => 'index_id',
        'requestId' => 'request_id',
        'redemptionPercentage' => 'redemption_percentage',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}

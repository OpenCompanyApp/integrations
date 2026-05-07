<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Purchase Fixed/Activity Project (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint POST /sapi/v1/lending/customizedFixed/purchase.
 */
class BinancePostSapiV1LendingCustomizedfixedPurchase extends AbstractBinanceTool
{
    protected const NAME = 'binance_post_sapi_v1_lending_customizedfixed_purchase';
    protected const DESCRIPTION = 'Purchase Fixed/Activity Project (USER_DATA)

Weight(IP): 1

Official Binance Spot endpoint: POST /sapi/v1/lending/customizedFixed/purchase.';
    protected const PARAMETERS = [
        'project_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'query parameter `projectId`.',
        ],
        'lot' => [
            'type' => 'string',
            'required' => true,
            'description' => 'query parameter `lot`.',
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
    protected const PATH = '/sapi/v1/lending/customizedFixed/purchase';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'projectId' => 'project_id',
        'lot' => 'lot',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}

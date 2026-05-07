<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Get Fixed/Activity Project Position (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/lending/project/position/list.
 */
class BinanceGetSapiV1LendingProjectPositionList extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_lending_project_position_list';
    protected const DESCRIPTION = 'Get Fixed/Activity Project Position (USER_DATA)

Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/lending/project/position/list.';
    protected const PARAMETERS = [
        'asset' => [
            'type' => 'string',
            'required' => true,
            'description' => 'query parameter `asset`.',
        ],
        'project_id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'query parameter `projectId`.',
        ],
        'status' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Default `ALL`',
            'enum' => [
                'ALL',
                'SUBSCRIBABLE',
                'UNSUBSCRIBABLE',
            ],
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
    protected const PATH = '/sapi/v1/lending/project/position/list';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'asset' => 'asset',
        'projectId' => 'project_id',
        'status' => 'status',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}

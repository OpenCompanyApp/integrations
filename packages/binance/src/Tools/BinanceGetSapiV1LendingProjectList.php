<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Get Fixed/Activity Project List(USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/lending/project/list.
 */
class BinanceGetSapiV1LendingProjectList extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_lending_project_list';
    protected const DESCRIPTION = 'Get Fixed/Activity Project List(USER_DATA)

Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/lending/project/list.';
    protected const PARAMETERS = [
        'asset' => [
            'type' => 'string',
            'required' => false,
            'description' => 'query parameter `asset`.',
        ],
        'type' => [
            'type' => 'string',
            'required' => true,
            'description' => 'query parameter `type`.',
            'enum' => [
                'ACTIVITY',
                'CUSTOMIZED_FIXED',
            ],
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
        'is_sort_asc' => [
            'type' => 'boolean',
            'required' => false,
            'description' => 'default "true"',
        ],
        'sort_by' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Default `START_TIME`',
            'enum' => [
                'START_TIME',
                'LOT_SIZE',
                'INTEREST_RATE',
                'DURATION',
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
    protected const PATH = '/sapi/v1/lending/project/list';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'asset' => 'asset',
        'type' => 'type',
        'status' => 'status',
        'isSortAsc' => 'is_sort_asc',
        'sortBy' => 'sort_by',
        'current' => 'current',
        'size' => 'size',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}

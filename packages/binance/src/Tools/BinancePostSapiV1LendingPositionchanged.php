<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Change Fixed/Activity Position to Daily Position (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint POST /sapi/v1/lending/positionChanged.
 */
class BinancePostSapiV1LendingPositionchanged extends AbstractBinanceTool
{
    protected const NAME = 'binance_post_sapi_v1_lending_positionchanged';
    protected const DESCRIPTION = 'Change Fixed/Activity Position to Daily Position (USER_DATA)

- PositionId is mandatory parameter for fixed position. Weight(IP): 1

Official Binance Spot endpoint: POST /sapi/v1/lending/positionChanged.';
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
        'position_id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'query parameter `positionId`.',
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
    protected const PATH = '/sapi/v1/lending/positionChanged';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'projectId' => 'project_id',
        'lot' => 'lot',
        'positionId' => 'position_id',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}

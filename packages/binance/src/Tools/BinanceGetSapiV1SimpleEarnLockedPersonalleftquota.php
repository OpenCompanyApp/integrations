<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Get Locked Personal Left Quota (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/simple-earn/locked/personalLeftQuota.
 */
class BinanceGetSapiV1SimpleEarnLockedPersonalleftquota extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_simple_earn_locked_personalleftquota';
    protected const DESCRIPTION = 'Get Locked Personal Left Quota (USER_DATA)

Weight(IP): 150

Official Binance Spot endpoint: GET /sapi/v1/simple-earn/locked/personalLeftQuota.';
    protected const PARAMETERS = [
        'project_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'query parameter `projectId`.',
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
    protected const PATH = '/sapi/v1/simple-earn/locked/personalLeftQuota';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'projectId' => 'project_id',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}

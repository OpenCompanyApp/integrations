<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Query holding details of the plan.
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/lending/auto-invest/plan/id.
 */
class BinanceGetSapiV1LendingAutoInvestPlanId extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_lending_auto_invest_plan_id';
    protected const DESCRIPTION = 'Query holding details of the plan

Query holding details of the plan Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/lending/auto-invest/plan/id.';
    protected const PARAMETERS = [
        'plan_id' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'query parameter `planId`.',
        ],
        'request_id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'query parameter `requestId`.',
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
    protected const PATH = '/sapi/v1/lending/auto-invest/plan/id';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'planId' => 'plan_id',
        'requestId' => 'request_id',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}

<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Get list of plans.
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/lending/auto-invest/plan/list.
 */
class BinanceGetSapiV1LendingAutoInvestPlanList extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_lending_auto_invest_plan_list';
    protected const DESCRIPTION = 'Get list of plans

Query plan lists Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/lending/auto-invest/plan/list.';
    protected const PARAMETERS = [
        'plan_type' => [
            'type' => 'string',
            'required' => true,
            'description' => 'query parameter `planType`.',
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
    protected const PATH = '/sapi/v1/lending/auto-invest/plan/list';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'planType' => 'plan_type',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}

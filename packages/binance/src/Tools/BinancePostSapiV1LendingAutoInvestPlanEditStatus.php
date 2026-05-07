<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Change Plan Status.
 *
 * Maps to the official Binance Spot endpoint POST /sapi/v1/lending/auto-invest/plan/edit-status.
 */
class BinancePostSapiV1LendingAutoInvestPlanEditStatus extends AbstractBinanceTool
{
    protected const NAME = 'binance_post_sapi_v1_lending_auto_invest_plan_edit_status';
    protected const DESCRIPTION = 'Change Plan Status

Change Plan Status Weight(IP): 1

Official Binance Spot endpoint: POST /sapi/v1/lending/auto-invest/plan/edit-status.';
    protected const PARAMETERS = [
        'plan_id' => [
            'type' => 'integer',
            'required' => true,
            'description' => 'query parameter `planId`.',
        ],
        'status' => [
            'type' => 'string',
            'required' => true,
            'description' => 'query parameter `status`.',
            'enum' => [
                'ONGOING',
                'PAUSED',
                'REMOVED',
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
    protected const METHOD = 'POST';
    protected const PATH = '/sapi/v1/lending/auto-invest/plan/edit-status';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'planId' => 'plan_id',
        'status' => 'status',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}

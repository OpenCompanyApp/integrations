<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Change Auto-Compound status(USER_DATA).
 *
 * Maps to the official Binance Spot endpoint POST /sapi/v1/dci/product/auto_compound/edit-status.
 */
class BinancePostSapiV1DciProductAutoCompoundEditStatus extends AbstractBinanceTool
{
    protected const NAME = 'binance_post_sapi_v1_dci_product_auto_compound_edit_status';
    protected const DESCRIPTION = 'Change Auto-Compound status(USER_DATA)

Change Auto-Compound status - 15:31 ~ 16:00 UTC+8 This function is disabled Weight(IP): 1 Rate Limit: Maximum 1 time/s per account

Official Binance Spot endpoint: POST /sapi/v1/dci/product/auto_compound/edit-status.';
    protected const PARAMETERS = [
        'position_id' => [
            'type' => 'integer',
            'required' => true,
            'description' => 'Get positionId from /sapi/v1/dci/product/positions',
        ],
        'auto_compound_plan' => [
            'type' => 'string',
            'required' => true,
            'description' => 'NONE: switch off the plan, STANDARD: standard plan, ADVANCED: advanced plan;',
            'enum' => [
                'NONE',
                'STANDARD',
                'ADVANCE',
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
    protected const PATH = '/sapi/v1/dci/product/auto_compound/edit-status';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'positionId' => 'position_id',
        'autoCompoundPlan' => 'auto_compound_plan',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}

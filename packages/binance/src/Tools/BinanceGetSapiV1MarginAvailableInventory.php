<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Query Margin Available Inventory (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/margin/available-inventory.
 */
class BinanceGetSapiV1MarginAvailableInventory extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_margin_available_inventory';
    protected const DESCRIPTION = 'Query Margin Available Inventory (USER_DATA)

Margin available Inventory query Weight(UID): 50

Official Binance Spot endpoint: GET /sapi/v1/margin/available-inventory.';
    protected const PARAMETERS = [
        'type' => [
            'type' => 'string',
            'required' => true,
            'description' => 'query parameter `type`.',
            'enum' => [
                'MARGIN',
                'ISOLATED',
            ],
        ],
        'timestamp' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'UTC timestamp in ms',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/sapi/v1/margin/available-inventory';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'type' => 'type',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}

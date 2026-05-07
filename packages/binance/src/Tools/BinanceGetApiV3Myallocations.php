<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Query Allocations (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /api/v3/myAllocations.
 */
class BinanceGetApiV3Myallocations extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_api_v3_myallocations';
    protected const DESCRIPTION = 'Query Allocations (USER_DATA)

Retrieves allocations resulting from SOR order placement. Weight: 20 Supported parameter combinations: Parameters Response symbol allocations from oldest to newest symbol + startTime oldest allocations since startTime symbol + endTime newest allocations until endTime symbol + startTime + endTime allocations within the time range symbol + fromAllocationId allocations by allocation ID symbol + orderId allocations related to an order starting with oldest symbol + orderId + fromAllocationId allocations related to an order by allocation ID Note: The time between startTime and endTime can\'t be longer than 24 hours.

Official Binance Spot endpoint: GET /api/v3/myAllocations.';
    protected const PARAMETERS = [
        'symbol' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Trading symbol, e.g. BNBUSDT',
        ],
        'start_time' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'UTC timestamp in ms',
        ],
        'end_time' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'UTC timestamp in ms',
        ],
        'from_allocation_id' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'query parameter `fromAllocationId`.',
        ],
        'limit' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'Default 500; max 1000.',
        ],
        'order_id' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'Order id',
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
    protected const PATH = '/api/v3/myAllocations';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'symbol' => 'symbol',
        'startTime' => 'start_time',
        'endTime' => 'end_time',
        'fromAllocationId' => 'from_allocation_id',
        'limit' => 'limit',
        'orderId' => 'order_id',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}

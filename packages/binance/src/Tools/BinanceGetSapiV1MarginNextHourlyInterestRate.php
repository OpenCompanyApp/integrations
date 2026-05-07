<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Get a future hourly interest rate (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/margin/next-hourly-interest-rate.
 */
class BinanceGetSapiV1MarginNextHourlyInterestRate extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_margin_next_hourly_interest_rate';
    protected const DESCRIPTION = 'Get a future hourly interest rate (USER_DATA)

Get user the next hourly estimate interest Weight(UID): 100

Official Binance Spot endpoint: GET /sapi/v1/margin/next-hourly-interest-rate.';
    protected const PARAMETERS = [
        'assets' => [
            'type' => 'string',
            'required' => false,
            'description' => 'List of assets, separated by commas, up to 20',
        ],
        'is_isolated' => [
            'type' => 'string',
            'required' => false,
            'description' => 'for isolated margin or not, "TRUE", "FALSE"',
            'enum' => [
                'TRUE',
                'FALSE',
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
    protected const PATH = '/sapi/v1/margin/next-hourly-interest-rate';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'assets' => 'assets',
        'isIsolated' => 'is_isolated',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}

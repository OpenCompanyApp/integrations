<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Get Small Liability Exchange History (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/margin/exchange-small-liability-history.
 */
class BinanceGetSapiV1MarginExchangeSmallLiabilityHistory extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_margin_exchange_small_liability_history';
    protected const DESCRIPTION = 'Get Small Liability Exchange History (USER_DATA)

Get Small liability Exchange History Weight(UID): 100

Official Binance Spot endpoint: GET /sapi/v1/margin/exchange-small-liability-history.';
    protected const PARAMETERS = [
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
    protected const PATH = '/sapi/v1/margin/exchange-small-liability-history';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'current' => 'current',
        'size' => 'size',
        'startTime' => 'start_time',
        'endTime' => 'end_time',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}

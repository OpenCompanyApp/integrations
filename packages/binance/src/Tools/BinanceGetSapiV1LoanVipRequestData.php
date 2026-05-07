<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Query Application Status (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/loan/vip/request/data.
 */
class BinanceGetSapiV1LoanVipRequestData extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_loan_vip_request_data';
    protected const DESCRIPTION = 'Query Application Status (USER_DATA)

Get Application Status Weight(UID): 400

Official Binance Spot endpoint: GET /sapi/v1/loan/vip/request/data.';
    protected const PARAMETERS = [
        'current' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'Current querying page. Start from 1. Default:1',
        ],
        'limit' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'Default 500; max 1000.',
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
    protected const PATH = '/sapi/v1/loan/vip/request/data';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'current' => 'current',
        'limit' => 'limit',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}

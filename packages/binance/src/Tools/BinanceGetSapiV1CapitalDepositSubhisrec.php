<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Sub-account Deposit History (For Master Account).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/capital/deposit/subHisrec.
 */
class BinanceGetSapiV1CapitalDepositSubhisrec extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_capital_deposit_subhisrec';
    protected const DESCRIPTION = 'Sub-account Deposit History (For Master Account)

Fetch sub-account deposit history Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/capital/deposit/subHisrec.';
    protected const PARAMETERS = [
        'email' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Sub-account email',
        ],
        'coin' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Coin name',
        ],
        'status' => [
            'type' => 'integer',
            'required' => false,
            'description' => '0(0:pending,6: credited but cannot withdraw, 1:success)',
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
        'limit' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'query parameter `limit`.',
        ],
        'offset' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'query parameter `offset`.',
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
    protected const PATH = '/sapi/v1/capital/deposit/subHisrec';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'email' => 'email',
        'coin' => 'coin',
        'status' => 'status',
        'startTime' => 'start_time',
        'endTime' => 'end_time',
        'limit' => 'limit',
        'offset' => 'offset',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}

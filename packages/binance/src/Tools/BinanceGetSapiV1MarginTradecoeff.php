<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Get Summary of Margin account (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/margin/tradeCoeff.
 */
class BinanceGetSapiV1MarginTradecoeff extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_margin_tradecoeff';
    protected const DESCRIPTION = 'Get Summary of Margin account (USER_DATA)

Get personal margin level information Weight(IP): 10

Official Binance Spot endpoint: GET /sapi/v1/margin/tradeCoeff.';
    protected const PARAMETERS = [
        'email' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Email Address',
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
    protected const PATH = '/sapi/v1/margin/tradeCoeff';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'email' => 'email',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}

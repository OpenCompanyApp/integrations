<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Futures Position-Risk of Sub-account V2 (For Master Account).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v2/sub-account/futures/positionRisk.
 */
class BinanceGetSapiV2SubAccountFuturesPositionrisk extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v2_sub_account_futures_positionrisk';
    protected const DESCRIPTION = 'Futures Position-Risk of Sub-account V2 (For Master Account)

Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v2/sub-account/futures/positionRisk.';
    protected const PARAMETERS = [
        'email' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Sub-account email',
        ],
        'futures_type' => [
            'type' => 'integer',
            'required' => true,
            'description' => '* `1` - USDT Margined Futures * `2` - COIN Margined Futures',
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
    protected const PATH = '/sapi/v2/sub-account/futures/positionRisk';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'email' => 'email',
        'futuresType' => 'futures_type',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}

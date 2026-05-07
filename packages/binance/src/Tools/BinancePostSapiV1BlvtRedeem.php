<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Redeem BLVT (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint POST /sapi/v1/blvt/redeem.
 */
class BinancePostSapiV1BlvtRedeem extends AbstractBinanceTool
{
    protected const NAME = 'binance_post_sapi_v1_blvt_redeem';
    protected const DESCRIPTION = 'Redeem BLVT (USER_DATA)

Weight(IP): 1

Official Binance Spot endpoint: POST /sapi/v1/blvt/redeem.';
    protected const PARAMETERS = [
        'token_name' => [
            'type' => 'string',
            'required' => true,
            'description' => 'BTCDOWN, BTCUP',
        ],
        'amount' => [
            'type' => 'number',
            'required' => true,
            'description' => 'query parameter `amount`.',
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
    protected const PATH = '/sapi/v1/blvt/redeem';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'tokenName' => 'token_name',
        'amount' => 'amount',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}

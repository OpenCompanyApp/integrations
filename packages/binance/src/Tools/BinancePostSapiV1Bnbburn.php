<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Toggle BNB Burn On Spot Trade And Margin Interest (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint POST /sapi/v1/bnbBurn.
 */
class BinancePostSapiV1Bnbburn extends AbstractBinanceTool
{
    protected const NAME = 'binance_post_sapi_v1_bnbburn';
    protected const DESCRIPTION = 'Toggle BNB Burn On Spot Trade And Margin Interest (USER_DATA)

- "spotBNBBurn" and "interestBNBBurn" should be sent at least one. Weight(IP): 1

Official Binance Spot endpoint: POST /sapi/v1/bnbBurn.';
    protected const PARAMETERS = [
        'spot_bnb_burn' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Determines whether to use BNB to pay for trading fees on SPOT',
            'enum' => [
                'true',
                'false',
            ],
        ],
        'interest_bnb_burn' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Determines whether to use BNB to pay for margin loan\'s interest',
            'enum' => [
                'true',
                'false',
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
    protected const PATH = '/sapi/v1/bnbBurn';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'spotBNBBurn' => 'spot_bnb_burn',
        'interestBNBBurn' => 'interest_bnb_burn',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}

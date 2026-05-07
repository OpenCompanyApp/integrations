<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Switch on/off BUSD and stable coins conversion (USER_DATA) (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint POST /sapi/v1/capital/contract/convertible-coins.
 */
class BinancePostSapiV1CapitalContractConvertibleCoins extends AbstractBinanceTool
{
    protected const NAME = 'binance_post_sapi_v1_capital_contract_convertible_coins';
    protected const DESCRIPTION = 'Switch on/off BUSD and stable coins conversion (USER_DATA) (USER_DATA)

User can use it to turn on or turn off the BUSD auto-conversion from/to a specific stable coin. Weight(UID): 600\'

Official Binance Spot endpoint: POST /sapi/v1/capital/contract/convertible-coins.';
    protected const PARAMETERS = [
        'coin' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Must be USDC, USDP or TUSD',
        ],
        'enable' => [
            'type' => 'boolean',
            'required' => true,
            'description' => 'true: turn on the auto-conversion. false: turn off the auto-conversion',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/sapi/v1/capital/contract/convertible-coins';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'coin' => 'coin',
        'enable' => 'enable',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'api_key';
}

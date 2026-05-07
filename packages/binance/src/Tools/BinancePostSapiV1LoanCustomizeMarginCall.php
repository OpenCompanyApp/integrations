<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Crypto Loan Customize Margin Call (TRADE).
 *
 * Maps to the official Binance Spot endpoint POST /sapi/v1/loan/customize/margin_call.
 */
class BinancePostSapiV1LoanCustomizeMarginCall extends AbstractBinanceTool
{
    protected const NAME = 'binance_post_sapi_v1_loan_customize_margin_call';
    protected const DESCRIPTION = 'Crypto Loan Customize Margin Call (TRADE)

Customize margin call for ongoing orders only. Weight(UID): 6000

Official Binance Spot endpoint: POST /sapi/v1/loan/customize/margin_call.';
    protected const PARAMETERS = [
        'order_id' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'Mandatory when collateralCoin is empty. Send either orderId or collateralCoin, if both parameters are sent, take orderId only.',
        ],
        'collateral_coin' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Coin used as collateral',
        ],
        'margin_call' => [
            'type' => 'number',
            'required' => true,
            'description' => 'query parameter `marginCall`.',
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
    protected const PATH = '/sapi/v1/loan/customize/margin_call';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'orderId' => 'order_id',
        'collateralCoin' => 'collateral_coin',
        'marginCall' => 'margin_call',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}

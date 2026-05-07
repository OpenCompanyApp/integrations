<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Crypto Loan Adjust LTV (TRADE).
 *
 * Maps to the official Binance Spot endpoint POST /sapi/v1/loan/adjust/ltv.
 */
class BinancePostSapiV1LoanAdjustLtv extends AbstractBinanceTool
{
    protected const NAME = 'binance_post_sapi_v1_loan_adjust_ltv';
    protected const DESCRIPTION = 'Crypto Loan Adjust LTV (TRADE)

Weight(UID): 6000

Official Binance Spot endpoint: POST /sapi/v1/loan/adjust/ltv.';
    protected const PARAMETERS = [
        'order_id' => [
            'type' => 'integer',
            'required' => true,
            'description' => 'Order ID',
        ],
        'amount' => [
            'type' => 'number',
            'required' => true,
            'description' => 'Amount',
        ],
        'direction' => [
            'type' => 'string',
            'required' => true,
            'description' => '\'ADDITIONAL\', \'REDUCED\'',
            'enum' => [
                'ADDITIONAL',
                'REDUCED',
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
    protected const PATH = '/sapi/v1/loan/adjust/ltv';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'orderId' => 'order_id',
        'amount' => 'amount',
        'direction' => 'direction',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}

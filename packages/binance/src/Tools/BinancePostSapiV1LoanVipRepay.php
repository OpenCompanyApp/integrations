<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * VIP Loan Repay (TRADE).
 *
 * Maps to the official Binance Spot endpoint POST /sapi/v1/loan/vip/repay.
 */
class BinancePostSapiV1LoanVipRepay extends AbstractBinanceTool
{
    protected const NAME = 'binance_post_sapi_v1_loan_vip_repay';
    protected const DESCRIPTION = 'VIP Loan Repay (TRADE)

VIP loan is available for VIP users only. Weight(UID): 6000

Official Binance Spot endpoint: POST /sapi/v1/loan/vip/repay.';
    protected const PARAMETERS = [
        'order_id' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'Order id',
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
    protected const PATH = '/sapi/v1/loan/vip/repay';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'orderId' => 'order_id',
        'amount' => 'amount',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}

<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * VIP Loan Renew.
 *
 * Maps to the official Binance Spot endpoint POST /sapi/v1/loan/vip/renew.
 */
class BinancePostSapiV1LoanVipRenew extends AbstractBinanceTool
{
    protected const NAME = 'binance_post_sapi_v1_loan_vip_renew';
    protected const DESCRIPTION = 'VIP Loan Renew

VIP loan is available for VIP users only. Weight(UID): 6000

Official Binance Spot endpoint: POST /sapi/v1/loan/vip/renew.';
    protected const PARAMETERS = [
        'order_id' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'Order id',
        ],
        'loan_term' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'query parameter `loanTerm`.',
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
    protected const PATH = '/sapi/v1/loan/vip/renew';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'orderId' => 'order_id',
        'loanTerm' => 'loan_term',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}

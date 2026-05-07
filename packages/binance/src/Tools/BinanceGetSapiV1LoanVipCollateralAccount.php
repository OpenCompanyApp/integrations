<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Check Locked Value of VIP Collateral Account (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/loan/vip/collateral/account.
 */
class BinanceGetSapiV1LoanVipCollateralAccount extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_loan_vip_collateral_account';
    protected const DESCRIPTION = 'Check Locked Value of VIP Collateral Account (USER_DATA)

VIP loan is available for VIP users only. Weight(IP): 6000

Official Binance Spot endpoint: GET /sapi/v1/loan/vip/collateral/account.';
    protected const PARAMETERS = [
        'order_id' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'Order id',
        ],
        'collateral_account_id' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'query parameter `collateralAccountId`.',
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
    protected const PATH = '/sapi/v1/loan/vip/collateral/account';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'orderId' => 'order_id',
        'collateralAccountId' => 'collateral_account_id',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}

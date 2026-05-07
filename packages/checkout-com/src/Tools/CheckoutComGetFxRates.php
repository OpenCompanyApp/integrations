<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Get FX rates.
 *
 * Maps to the official Checkout.com endpoint GET /forex/rates.
 */
class CheckoutComGetFxRates extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_get_fx_rates';
    protected const DESCRIPTION = 'Get the indicative foreign exchange (FX) rates that Checkout.com uses to process payments for the following products: - Card Payouts - Daily acquiring >Note: Ensure that you have the relevant product enabled for your account. Otherwise, you receive a `403 Forbidden` error response.

Official Checkout.com endpoint: GET /forex/rates.';
    protected const PARAMETERS = [
        'product' => [
            'type' => 'string',
            'required' => true,
            'description' => 'product',
            'enum' => ['card_payouts', 'daily_acquiring', 'scheme_acquiring'],
        ],
        'source' => [
            'type' => 'string',
            'required' => true,
            'description' => 'source',
            'enum' => ['mastercard', 'visa'],
        ],
        'currency_pairs' => [
            'type' => 'string',
            'required' => true,
            'description' => 'currency_pairs',
        ],
        'processing_channel_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'processing_channel_id',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/forex/rates';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'product' => 'product',
        'source' => 'source',
        'currency_pairs' => 'currency_pairs',
        'processing_channel_id' => 'processing_channel_id',
    ];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}

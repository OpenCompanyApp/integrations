<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Query payment instruments.
 *
 * Maps to the official Checkout.com endpoint GET /accounts/entities/{id}/payment-instruments.
 */
class CheckoutComQueryPlatformsPaymentInstruments extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_query_platforms_payment_instruments';
    protected const DESCRIPTION = 'Fetch all of the payment instruments for a sub-entity. You can filter by `status` to identify `verified` instruments that are ready to be used for Payouts.

Official Checkout.com endpoint: GET /accounts/entities/{id}/payment-instruments.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The sub-entity\'s ID.',
        ],
        'status' => [
            'type' => 'string',
            'required' => false,
            'description' => 'status',
            'enum' => ['pending', 'verified', 'unverified'],
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/accounts/entities/{id}/payment-instruments';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [
        'status' => 'status',
    ];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}

<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Add a payment instrument.
 *
 * Maps to the official Checkout.com endpoint POST /accounts/entities/{id}/payment-instruments.
 */
class CheckoutComAddPlatformsPaymentInstrument extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_add_platforms_payment_instrument';
    protected const DESCRIPTION = 'Create a bank account payment instrument for your sub-entity. You can use this payment instrument as a payout destination.

Official Checkout.com endpoint: POST /accounts/entities/{id}/payment-instruments.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The sub-entity\'s ID.',
        ],
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/accounts/entities/{id}/payment-instruments';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}

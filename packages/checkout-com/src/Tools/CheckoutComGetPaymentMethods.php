<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Get available payment methods.
 *
 * Maps to the official Checkout.com endpoint GET /payment-methods.
 */
class CheckoutComGetPaymentMethods extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_get_payment_methods';
    protected const DESCRIPTION = 'Beta Get a list of all available payment methods for a specific Processing Channel ID.

Official Checkout.com endpoint: GET /payment-methods.';
    protected const PARAMETERS = [
        'processing_channel_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'processing_channel_id',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/payment-methods';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'processing_channel_id' => 'processing_channel_id',
    ];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}

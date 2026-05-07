<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Create a Payment Setup.
 *
 * Maps to the official Checkout.com endpoint POST /payments/setups.
 */
class CheckoutComCreateAPaymentSetup extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_create_a_payment_setup';
    protected const DESCRIPTION = 'Beta Creates a Payment Setup. To maximize the information available to the payment setup, create a Payment Setup as early as possible in the customer\'s journey. For example, create it the first time they land on the basket page.

Official Checkout.com endpoint: POST /payments/setups.';
    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/payments/setups';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}

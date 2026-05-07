<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Get a Payment Setup.
 *
 * Maps to the official Checkout.com endpoint GET /payments/setups/{id}.
 */
class CheckoutComGetAPaymentSetup extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_get_a_payment_setup';
    protected const DESCRIPTION = 'Beta Retrieves a Payment Setup by its unique identifier.

Official Checkout.com endpoint: GET /payments/setups/{id}.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The unique identifier of the Payment Setup to retrieve.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/payments/setups/{id}';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}

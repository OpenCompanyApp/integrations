<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Confirm a Payment Setup.
 *
 * Maps to the official Checkout.com endpoint POST /payments/setups/{id}/confirm/{payment_method_name}.
 */
class CheckoutComConfirmAPaymentSetup extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_confirm_a_payment_setup';
    protected const DESCRIPTION = 'Beta Confirm a Payment Setup to begin processing the payment request with your chosen payment method.

Official Checkout.com endpoint: POST /payments/setups/{id}/confirm/{payment_method_name}.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The unique identifier of the Payment Setup.',
        ],
        'payment_method_name' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The name of the payment method to process the payment with (For example, `tabby`, `klarna`, `card`).',
        ],
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/payments/setups/{id}/confirm/{payment_method_name}';
    protected const PATH_PARAMS = [
        'id' => 'id',
        'payment_method_name' => 'payment_method_name',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}

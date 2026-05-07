<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Update a Payment Setup.
 *
 * Maps to the official Checkout.com endpoint PUT /payments/setups/{id}.
 */
class CheckoutComUpdateAPaymentSetup extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_update_a_payment_setup';
    protected const DESCRIPTION = 'Beta Updates a Payment Setup. Update the Payment Setup whenever there are significant changes in the data relevant to the customer\'s transaction. For example, when the customer makes a change that impacts the total payment amount.

Official Checkout.com endpoint: PUT /payments/setups/{id}.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The unique identifier of the Payment Setup to update.',
        ],
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'PUT';
    protected const PATH = '/payments/setups/{id}';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}

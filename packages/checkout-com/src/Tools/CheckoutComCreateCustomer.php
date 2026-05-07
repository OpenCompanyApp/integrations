<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Create a customer.
 *
 * Maps to the official Checkout.com endpoint POST /customers.
 */
class CheckoutComCreateCustomer extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_create_customer';
    protected const DESCRIPTION = 'Store a customer\'s details in a customer object to reuse in future payments. When creating a customer, you can link payment instruments – the customer `id` returned can be passed as a source when making a payment.  **NOTE:** Specify a `default` instrument, otherwise the `instruments` array will not be saved on creation.

Official Checkout.com endpoint: POST /customers.';
    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/customers';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}

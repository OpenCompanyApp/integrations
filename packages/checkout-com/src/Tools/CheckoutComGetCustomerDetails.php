<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Get customer details.
 *
 * Maps to the official Checkout.com endpoint GET /customers/{identifier}.
 */
class CheckoutComGetCustomerDetails extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_get_customer_details';
    protected const DESCRIPTION = 'Returns the details of a customer and their payment instruments.

Official Checkout.com endpoint: GET /customers/{identifier}.';
    protected const PARAMETERS = [
        'identifier' => [
            'type' => 'object',
            'required' => true,
            'description' => 'The customer\'s ID or email',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/customers/{identifier}';
    protected const PATH_PARAMS = [
        'identifier' => 'identifier',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}

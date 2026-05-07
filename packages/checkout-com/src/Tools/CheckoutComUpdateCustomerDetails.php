<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Update customer details.
 *
 * Maps to the official Checkout.com endpoint PATCH /customers/{identifier}.
 */
class CheckoutComUpdateCustomerDetails extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_update_customer_details';
    protected const DESCRIPTION = 'Update the details of a customer and link payment instruments to them.

Official Checkout.com endpoint: PATCH /customers/{identifier}.';
    protected const PARAMETERS = [
        'identifier' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The customer\'s ID',
        ],
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'PATCH';
    protected const PATH = '/customers/{identifier}';
    protected const PATH_PARAMS = [
        'identifier' => 'identifier',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}

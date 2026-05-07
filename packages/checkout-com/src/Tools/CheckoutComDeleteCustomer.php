<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Delete a customer.
 *
 * Maps to the official Checkout.com endpoint DELETE /customers/{identifier}.
 */
class CheckoutComDeleteCustomer extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_delete_customer';
    protected const DESCRIPTION = 'Delete a customer and all of their linked payment instruments.

Official Checkout.com endpoint: DELETE /customers/{identifier}.';
    protected const PARAMETERS = [
        'identifier' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The customer\'s ID',
        ],
    ];
    protected const METHOD = 'DELETE';
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

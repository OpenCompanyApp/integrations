<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Get Hosted Payments Page details.
 *
 * Maps to the official Checkout.com endpoint GET /hosted-payments/{id}.
 */
class CheckoutComGetHostedPaymentsPageDetails extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_get_hosted_payments_page_details';
    protected const DESCRIPTION = 'Retrieve details about a specific Hosted Payments Page using the ID returned when it was created. In the response, you will see the status of the Hosted Payments Page. For more information, see the Hosted Payments Page documentation.

Official Checkout.com endpoint: GET /hosted-payments/{id}.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'object',
            'required' => true,
            'description' => 'id',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/hosted-payments/{id}';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}

<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Get Payment Link details.
 *
 * Maps to the official Checkout.com endpoint GET /payment-links/{id}.
 */
class CheckoutComGetPaymentLinkDetails extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_get_payment_link_details';
    protected const DESCRIPTION = 'Retrieve details about a specific Payment Link using its ID returned when the link was created. In the response, you will see the status of the Payment Link. For more information, see the Payment Links documentation.

Official Checkout.com endpoint: GET /payment-links/{id}.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'object',
            'required' => true,
            'description' => 'id',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/payment-links/{id}';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}

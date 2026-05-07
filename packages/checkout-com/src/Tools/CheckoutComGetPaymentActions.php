<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Get payment actions.
 *
 * Maps to the official Checkout.com endpoint GET /payments/{id}/actions.
 */
class CheckoutComGetPaymentActions extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_get_payment_actions';
    protected const DESCRIPTION = 'Returns all the actions associated with a payment ordered by processing date in descending order (latest first).

Official Checkout.com endpoint: GET /payments/{id}/actions.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The payment identifier',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/payments/{id}/actions';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}

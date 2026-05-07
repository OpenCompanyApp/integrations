<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Simulate refund.
 *
 * Maps to the official Checkout.com endpoint POST /issuing/simulate/authorizations/{id}/refunds.
 */
class CheckoutComSimulateRefund extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_simulate_refund';
    protected const DESCRIPTION = 'Simulate the refund of an existing approved authorization, after it has been cleared.

Official Checkout.com endpoint: POST /issuing/simulate/authorizations/{id}/refunds.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'id',
        ],
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/issuing/simulate/authorizations/{id}/refunds';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}

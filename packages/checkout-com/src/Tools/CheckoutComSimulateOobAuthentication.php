<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Simulate an out-of-band (OOB) authentication request..
 *
 * Maps to the official Checkout.com endpoint POST /issuing/simulate/oob/authentication.
 */
class CheckoutComSimulateOobAuthentication extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_simulate_oob_authentication';
    protected const DESCRIPTION = 'Simulate a request to your back-end from an out-of-band (OOB) authentication provider.

Official Checkout.com endpoint: POST /issuing/simulate/oob/authentication.';
    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/issuing/simulate/oob/authentication';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}

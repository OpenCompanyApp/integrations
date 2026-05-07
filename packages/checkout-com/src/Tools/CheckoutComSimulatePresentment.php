<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Simulate clearing.
 *
 * Maps to the official Checkout.com endpoint POST /issuing/simulate/authorizations/{id}/presentments.
 */
class CheckoutComSimulatePresentment extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_simulate_presentment';
    protected const DESCRIPTION = 'Simulate the clearing of an existing approved authorization.

Official Checkout.com endpoint: POST /issuing/simulate/authorizations/{id}/presentments.';
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
    protected const PATH = '/issuing/simulate/authorizations/{id}/presentments';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}

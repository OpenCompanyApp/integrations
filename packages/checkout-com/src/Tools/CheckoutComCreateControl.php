<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Create a control.
 *
 * Maps to the official Checkout.com endpoint POST /issuing/controls.
 */
class CheckoutComCreateControl extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_create_control';
    protected const DESCRIPTION = 'Creates a control and applies it to the specified target.

Official Checkout.com endpoint: POST /issuing/controls.';
    protected const PARAMETERS = [
        'cko_idempotency_key' => [
            'type' => 'string',
            'required' => false,
            'description' => 'An optional idempotency key for safely retrying Issuing requests.',
        ],
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/issuing/controls';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [
        'Cko-Idempotency-Key' => 'cko_idempotency_key',
    ];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}

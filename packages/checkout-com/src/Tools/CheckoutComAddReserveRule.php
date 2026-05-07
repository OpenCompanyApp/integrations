<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Add a reserve rule.
 *
 * Maps to the official Checkout.com endpoint POST /accounts/entities/{id}/reserve-rules.
 */
class CheckoutComAddReserveRule extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_add_reserve_rule';
    protected const DESCRIPTION = 'Create a sub-entity reserve rule.

Official Checkout.com endpoint: POST /accounts/entities/{id}/reserve-rules.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The sub-entity\'s ID.',
        ],
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/accounts/entities/{id}/reserve-rules';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}

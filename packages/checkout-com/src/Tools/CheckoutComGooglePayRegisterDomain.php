<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Register a web domain for an enrolled entity.
 *
 * Maps to the official Checkout.com endpoint POST /googlepay/enrollments/{entity_id}/domain.
 */
class CheckoutComGooglePayRegisterDomain extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_google_pay_register_domain';
    protected const DESCRIPTION = 'Associates a web domain with the specified enrolled entity.

Official Checkout.com endpoint: POST /googlepay/enrollments/{entity_id}/domain.';
    protected const PARAMETERS = [
        'entity_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Unique identifier of the entity.',
        ],
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/googlepay/enrollments/{entity_id}/domain';
    protected const PATH_PARAMS = [
        'entity_id' => 'entity_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}

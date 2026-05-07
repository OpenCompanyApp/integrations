<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Get registered domains for an entity.
 *
 * Maps to the official Checkout.com endpoint GET /googlepay/enrollments/{entity_id}/domains.
 */
class CheckoutComGooglePayGetRegisteredDomains extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_google_pay_get_registered_domains';
    protected const DESCRIPTION = 'Retrieves all web domains registered for the specified entity.

Official Checkout.com endpoint: GET /googlepay/enrollments/{entity_id}/domains.';
    protected const PARAMETERS = [
        'entity_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Unique identifier of the entity.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/googlepay/enrollments/{entity_id}/domains';
    protected const PATH_PARAMS = [
        'entity_id' => 'entity_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}

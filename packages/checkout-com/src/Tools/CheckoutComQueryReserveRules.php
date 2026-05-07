<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Query reserve rules.
 *
 * Maps to the official Checkout.com endpoint GET /accounts/entities/{id}/reserve-rules.
 */
class CheckoutComQueryReserveRules extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_query_reserve_rules';
    protected const DESCRIPTION = 'Fetch all of the reserve rules for a sub-entity.

Official Checkout.com endpoint: GET /accounts/entities/{id}/reserve-rules.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The sub-entity\'s ID.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/accounts/entities/{id}/reserve-rules';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}

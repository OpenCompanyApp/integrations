<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Get reserve rule details.
 *
 * Maps to the official Checkout.com endpoint GET /accounts/entities/{entityId}/reserve-rules/{id}.
 */
class CheckoutComGetReserveRule extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_get_reserve_rule';
    protected const DESCRIPTION = 'Retrieve the details of a specific reserve rule.

Official Checkout.com endpoint: GET /accounts/entities/{entityId}/reserve-rules/{id}.';
    protected const PARAMETERS = [
        'entity_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The sub-entity\'s ID.',
        ],
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The reserve rule ID.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/accounts/entities/{entityId}/reserve-rules/{id}';
    protected const PATH_PARAMS = [
        'entityId' => 'entity_id',
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}

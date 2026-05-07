<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Update reserve rule.
 *
 * Maps to the official Checkout.com endpoint PUT /accounts/entities/{entityId}/reserve-rules/{id}.
 */
class CheckoutComUpdateReserveRule extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_update_reserve_rule';
    protected const DESCRIPTION = 'Update an upcoming reserve rule. Only reserve rules that have never been active can be updated.

Official Checkout.com endpoint: PUT /accounts/entities/{entityId}/reserve-rules/{id}.';
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
        'if_match' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Identifies a specific version of a reserve rule to update.',
        ],
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'PUT';
    protected const PATH = '/accounts/entities/{entityId}/reserve-rules/{id}';
    protected const PATH_PARAMS = [
        'entityId' => 'entity_id',
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [
        'If-Match' => 'if_match',
    ];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}

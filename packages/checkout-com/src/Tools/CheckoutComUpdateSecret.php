<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Update secret.
 *
 * Maps to the official Checkout.com endpoint PATCH /forward/secrets/{name}.
 */
class CheckoutComUpdateSecret extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_update_secret';
    protected const DESCRIPTION = 'Update an existing secret. After updating, the version is automatically incremented. **Validation Rules:** - Only `value` and `entity_id` can be updated - `value`: max 8KB **Response:** Returns updated metadata with incremented version.

Official Checkout.com endpoint: PATCH /forward/secrets/{name}.';
    protected const PARAMETERS = [
        'name' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Secret name.',
        ],
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'PATCH';
    protected const PATH = '/forward/secrets/{name}';
    protected const PATH_PARAMS = [
        'name' => 'name',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}

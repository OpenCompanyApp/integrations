<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Create secret.
 *
 * Maps to the official Checkout.com endpoint POST /forward/secrets.
 */
class CheckoutComCreateSecret extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_create_secret';
    protected const DESCRIPTION = 'Create a new secret with a plaintext value. **Validation Rules:** - `name`: 1-64 characters, alphanumeric + underscore - `value`: max 8KB - `entity_id` (optional): when provided, secret is scoped to this entity **Response:** Returns metadata.

Official Checkout.com endpoint: POST /forward/secrets.';
    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/forward/secrets';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}

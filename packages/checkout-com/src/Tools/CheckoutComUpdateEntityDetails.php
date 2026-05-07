<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Update entity details.
 *
 * Maps to the official Checkout.com endpoint PUT /accounts/entities/{id}.
 */
class CheckoutComUpdateEntityDetails extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_update_entity_details';
    protected const DESCRIPTION = 'Update an entity. **Note:** when you update a entity we may conduct further due diligence checks when necessary. During these checks, your payment capabilities will remain the same.

Official Checkout.com endpoint: PUT /accounts/entities/{id}.';
    protected const PARAMETERS = [
        'accept' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Used to describe the type of content the client can interpret. Use the schema_version value to specify the payload format. The latest version is 3.0.',
        ],
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The ID of the entity.',
        ],
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'PUT';
    protected const PATH = '/accounts/entities/{id}';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [
        'Accept' => 'accept',
    ];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}

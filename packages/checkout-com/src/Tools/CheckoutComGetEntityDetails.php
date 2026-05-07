<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Get entity details.
 *
 * Maps to the official Checkout.com endpoint GET /accounts/entities/{id}.
 */
class CheckoutComGetEntityDetails extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_get_entity_details';
    protected const DESCRIPTION = 'Use this endpoint to retrieve an entity and its full details.

Official Checkout.com endpoint: GET /accounts/entities/{id}.';
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
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/accounts/entities/{id}';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [
        'Accept' => 'accept',
    ];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}

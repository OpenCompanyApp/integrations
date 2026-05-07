<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Onboard an entity.
 *
 * Maps to the official Checkout.com endpoint POST /accounts/entities.
 */
class CheckoutComOnboardEntity extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_onboard_entity';
    protected const DESCRIPTION = 'Onboard an entity so they can start using Checkout services.

Official Checkout.com endpoint: POST /accounts/entities.';
    protected const PARAMETERS = [
        'accept' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Used to describe the type of content the client can interpret. Use the schema_version value to specify the payload format. The latest version is 3.0.',
        ],
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/accounts/entities';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [
        'Accept' => 'accept',
    ];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}

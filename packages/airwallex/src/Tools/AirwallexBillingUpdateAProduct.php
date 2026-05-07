<?php

namespace OpenCompany\Integrations\Airwallex\Tools;

/**
 * Billing > Products > Update a Product.
 *
 * Maps to the official Airwallex endpoint POST /api/v1/products/{product_id}/update.
 */
class AirwallexBillingUpdateAProduct extends AbstractAirwallexTool
{
    protected const NAME = 'airwallex_billing_update_a_product';
    protected const DESCRIPTION = 'Billing > Products > Update a Product.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/products/{product_id}/update.';
    protected const PARAMETERS = [
        'product_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Path parameter `product_id`.',
        ],
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/products/{product_id}/update';
    protected const BASE = 'api';
    protected const PATH_PARAMS = [
        'product_id' => 'product_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}

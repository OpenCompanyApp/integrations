<?php

namespace OpenCompany\Integrations\Airwallex\Tools;

/**
 * Billing > Products > Retrieve a Product.
 *
 * Maps to the official Airwallex endpoint GET /api/v1/products/{product_id}.
 */
class AirwallexBillingRetrieveAProduct extends AbstractAirwallexTool
{
    protected const NAME = 'airwallex_billing_retrieve_a_product';
    protected const DESCRIPTION = 'Billing > Products > Retrieve a Product.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/products/{product_id}.';
    protected const PARAMETERS = [
        'product_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Path parameter `product_id`.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/products/{product_id}';
    protected const BASE = 'api';
    protected const PATH_PARAMS = [
        'product_id' => 'product_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}

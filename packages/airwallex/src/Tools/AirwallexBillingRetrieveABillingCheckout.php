<?php

namespace OpenCompany\Integrations\Airwallex\Tools;

/**
 * Billing > Billing Checkouts > Retrieve a Billing checkout.
 *
 * Maps to the official Airwallex endpoint GET /api/v1/billing_checkouts/{billing_checkout_id}.
 */
class AirwallexBillingRetrieveABillingCheckout extends AbstractAirwallexTool
{
    protected const NAME = 'airwallex_billing_retrieve_a_billing_checkout';
    protected const DESCRIPTION = 'Billing > Billing Checkouts > Retrieve a Billing checkout.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/billing_checkouts/{billing_checkout_id}.';
    protected const PARAMETERS = [
        'billing_checkout_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Path parameter `billing_checkout_id`.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/billing_checkouts/{billing_checkout_id}';
    protected const BASE = 'api';
    protected const PATH_PARAMS = [
        'billing_checkout_id' => 'billing_checkout_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}

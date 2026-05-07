<?php

namespace OpenCompany\Integrations\Airwallex\Tools;

/**
 * Billing > Billing Customers > Update a Billing Customer.
 *
 * Maps to the official Airwallex endpoint POST /api/v1/billing_customers/{billing_customer_id}/update.
 */
class AirwallexBillingUpdateABillingCustomer extends AbstractAirwallexTool
{
    protected const NAME = 'airwallex_billing_update_a_billing_customer';
    protected const DESCRIPTION = 'Billing > Billing Customers > Update a Billing Customer.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/billing_customers/{billing_customer_id}/update.';
    protected const PARAMETERS = [
        'billing_customer_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Path parameter `billing_customer_id`.',
        ],
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/billing_customers/{billing_customer_id}/update';
    protected const BASE = 'api';
    protected const PATH_PARAMS = [
        'billing_customer_id' => 'billing_customer_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}

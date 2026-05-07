<?php

namespace OpenCompany\Integrations\Airwallex\Tools;

/**
 * Billing > Billing Customers > Retrieve a Billing Customer.
 *
 * Maps to the official Airwallex endpoint GET /api/v1/billing_customers/{billing_customer_id}.
 */
class AirwallexBillingRetrieveABillingCustomer extends AbstractAirwallexTool
{
    protected const NAME = 'airwallex_billing_retrieve_a_billing_customer';
    protected const DESCRIPTION = 'Billing > Billing Customers > Retrieve a Billing Customer.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/billing_customers/{billing_customer_id}.';
    protected const PARAMETERS = [
        'billing_customer_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Path parameter `billing_customer_id`.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/billing_customers/{billing_customer_id}';
    protected const BASE = 'api';
    protected const PATH_PARAMS = [
        'billing_customer_id' => 'billing_customer_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}

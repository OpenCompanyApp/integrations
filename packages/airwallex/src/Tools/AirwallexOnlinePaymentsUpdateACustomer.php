<?php

namespace OpenCompany\Integrations\Airwallex\Tools;

/**
 * Online Payments > Customers > Update a Customer.
 *
 * Maps to the official Airwallex endpoint POST /api/v1/pa/customers/{customer_id}/update.
 */
class AirwallexOnlinePaymentsUpdateACustomer extends AbstractAirwallexTool
{
    protected const NAME = 'airwallex_online_payments_update_a_customer';
    protected const DESCRIPTION = 'Online Payments > Customers > Update a Customer.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/pa/customers/{customer_id}/update.';
    protected const PARAMETERS = [
        'customer_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Path parameter `customer_id`.',
        ],
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/pa/customers/{customer_id}/update';
    protected const BASE = 'api';
    protected const PATH_PARAMS = [
        'customer_id' => 'customer_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}

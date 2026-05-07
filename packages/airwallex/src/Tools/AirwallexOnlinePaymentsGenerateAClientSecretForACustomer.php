<?php

namespace OpenCompany\Integrations\Airwallex\Tools;

/**
 * Online Payments > Customers > Generate a client secret for a Customer.
 *
 * Maps to the official Airwallex endpoint GET /api/v1/pa/customers/{customer_id}/generate_client_secret.
 */
class AirwallexOnlinePaymentsGenerateAClientSecretForACustomer extends AbstractAirwallexTool
{
    protected const NAME = 'airwallex_online_payments_generate_a_client_secret_for_a_customer';
    protected const DESCRIPTION = 'Online Payments > Customers > Generate a client secret for a Customer.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/pa/customers/{customer_id}/generate_client_secret.';
    protected const PARAMETERS = [
        'customer_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Path parameter `customer_id`.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/pa/customers/{customer_id}/generate_client_secret';
    protected const BASE = 'api';
    protected const PATH_PARAMS = [
        'customer_id' => 'customer_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}

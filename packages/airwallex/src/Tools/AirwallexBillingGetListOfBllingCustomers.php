<?php

namespace OpenCompany\Integrations\Airwallex\Tools;

/**
 * Billing > Billing Customers > Get list of Blling Customers.
 *
 * Maps to the official Airwallex endpoint GET /api/v1/billing_customers.
 */
class AirwallexBillingGetListOfBllingCustomers extends AbstractAirwallexTool
{
    protected const NAME = 'airwallex_billing_get_list_of_blling_customers';
    protected const DESCRIPTION = 'Billing > Billing Customers > Get list of Blling Customers.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/billing_customers.';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/billing_customers';
    protected const BASE = 'api';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}

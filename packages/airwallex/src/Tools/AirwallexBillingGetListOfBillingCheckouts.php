<?php

namespace OpenCompany\Integrations\Airwallex\Tools;

/**
 * Billing > Billing Checkouts > Get list of Billing Checkouts.
 *
 * Maps to the official Airwallex endpoint GET /api/v1/billing_checkouts.
 */
class AirwallexBillingGetListOfBillingCheckouts extends AbstractAirwallexTool
{
    protected const NAME = 'airwallex_billing_get_list_of_billing_checkouts';
    protected const DESCRIPTION = 'Billing > Billing Checkouts > Get list of Billing Checkouts.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/billing_checkouts.';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/billing_checkouts';
    protected const BASE = 'api';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}

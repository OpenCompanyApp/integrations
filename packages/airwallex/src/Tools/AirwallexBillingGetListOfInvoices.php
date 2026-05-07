<?php

namespace OpenCompany\Integrations\Airwallex\Tools;

/**
 * Billing > Invoices > Get list of Invoices.
 *
 * Maps to the official Airwallex endpoint GET /api/v1/invoices.
 */
class AirwallexBillingGetListOfInvoices extends AbstractAirwallexTool
{
    protected const NAME = 'airwallex_billing_get_list_of_invoices';
    protected const DESCRIPTION = 'Billing > Invoices > Get list of Invoices.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/invoices.';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/invoices';
    protected const BASE = 'api';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}

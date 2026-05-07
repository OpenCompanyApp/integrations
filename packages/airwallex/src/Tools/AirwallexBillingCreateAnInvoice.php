<?php

namespace OpenCompany\Integrations\Airwallex\Tools;

/**
 * Billing > Invoices > Create an Invoice.
 *
 * Maps to the official Airwallex endpoint POST /api/v1/invoices/create.
 */
class AirwallexBillingCreateAnInvoice extends AbstractAirwallexTool
{
    protected const NAME = 'airwallex_billing_create_an_invoice';
    protected const DESCRIPTION = 'Billing > Invoices > Create an Invoice.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/invoices/create.';
    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/invoices/create';
    protected const BASE = 'api';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}

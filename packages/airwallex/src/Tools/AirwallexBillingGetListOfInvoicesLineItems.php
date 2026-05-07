<?php

namespace OpenCompany\Integrations\Airwallex\Tools;

/**
 * Billing > Invoices > Get list of Invoices Line Items.
 *
 * Maps to the official Airwallex endpoint GET /api/v1/invoices/{invoice_id}/line_items.
 */
class AirwallexBillingGetListOfInvoicesLineItems extends AbstractAirwallexTool
{
    protected const NAME = 'airwallex_billing_get_list_of_invoices_line_items';
    protected const DESCRIPTION = 'Billing > Invoices > Get list of Invoices Line Items.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/invoices/{invoice_id}/line_items.';
    protected const PARAMETERS = [
        'invoice_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Path parameter `invoice_id`.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/invoices/{invoice_id}/line_items';
    protected const BASE = 'api';
    protected const PATH_PARAMS = [
        'invoice_id' => 'invoice_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}

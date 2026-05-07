<?php

namespace OpenCompany\Integrations\Airwallex\Tools;

/**
 * Billing > Invoices > Create Invoice Line Items and add them to an Invoice.
 *
 * Maps to the official Airwallex endpoint POST /api/v1/invoices/{invoice_id}/add_line_items.
 */
class AirwallexBillingCreateInvoiceLineItemsAndAddThemToAnInvoice extends AbstractAirwallexTool
{
    protected const NAME = 'airwallex_billing_create_invoice_line_items_and_add_them_to_an_invoice';
    protected const DESCRIPTION = 'Billing > Invoices > Create Invoice Line Items and add them to an Invoice.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/invoices/{invoice_id}/add_line_items.';
    protected const PARAMETERS = [
        'invoice_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Path parameter `invoice_id`.',
        ],
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/invoices/{invoice_id}/add_line_items';
    protected const BASE = 'api';
    protected const PATH_PARAMS = [
        'invoice_id' => 'invoice_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}

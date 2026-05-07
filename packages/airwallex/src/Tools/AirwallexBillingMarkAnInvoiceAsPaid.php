<?php

namespace OpenCompany\Integrations\Airwallex\Tools;

/**
 * Billing > Invoices > Mark an Invoice as Paid.
 *
 * Maps to the official Airwallex endpoint POST /api/v1/invoices/{invoice_id}/mark_as_paid.
 */
class AirwallexBillingMarkAnInvoiceAsPaid extends AbstractAirwallexTool
{
    protected const NAME = 'airwallex_billing_mark_an_invoice_as_paid';
    protected const DESCRIPTION = 'Billing > Invoices > Mark an Invoice as Paid.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/invoices/{invoice_id}/mark_as_paid.';
    protected const PARAMETERS = [
        'invoice_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Path parameter `invoice_id`.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/invoices/{invoice_id}/mark_as_paid';
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

<?php

namespace OpenCompany\Integrations\InvoiceNinja\Tools;

/**
 * Create an Invoice Ninja recurring invoice.
 */
class InvoiceNinjaCreateRecurringInvoice extends AbstractInvoiceNinjaEndpointTool
{
    protected array $parameters = [
            'payload' => ['type' => 'object', 'required' => true, 'description' => 'Request payload matching the Invoice Ninja API schema for this endpoint.'],
    ];

    protected array $required = ['payload'];

    protected array $queryParams = [];

    protected array $bodyParams = ['payload'];

    protected string $method = 'POST';

    protected string $path = '/api/v1/recurring_invoices';

    protected string $toolName = 'invoiceninja_create_recurring_invoice';

    protected string $toolDescription = 'Create an Invoice Ninja recurring invoice.';
}

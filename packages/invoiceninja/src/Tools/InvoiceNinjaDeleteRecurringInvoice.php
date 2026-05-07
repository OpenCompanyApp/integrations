<?php

namespace OpenCompany\Integrations\InvoiceNinja\Tools;

/**
 * Delete or archive an Invoice Ninja recurring invoice by ID.
 */
class InvoiceNinjaDeleteRecurringInvoice extends AbstractInvoiceNinjaEndpointTool
{
    protected array $parameters = [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Resource hashed ID.'],
    ];

    protected array $required = ['id'];

    protected array $queryParams = [];

    protected array $bodyParams = [];

    protected string $method = 'DELETE';

    protected string $path = '/api/v1/recurring_invoices/{id}';

    protected string $toolName = 'invoiceninja_delete_recurring_invoice';

    protected string $toolDescription = 'Delete or archive an Invoice Ninja recurring invoice by ID.';
}

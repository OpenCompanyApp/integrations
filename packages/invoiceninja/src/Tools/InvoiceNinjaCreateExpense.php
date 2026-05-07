<?php

namespace OpenCompany\Integrations\InvoiceNinja\Tools;

/**
 * Create an Invoice Ninja expense.
 */
class InvoiceNinjaCreateExpense extends AbstractInvoiceNinjaEndpointTool
{
    protected array $parameters = [
            'payload' => ['type' => 'object', 'required' => true, 'description' => 'Request payload matching the Invoice Ninja API schema for this endpoint.'],
    ];

    protected array $required = ['payload'];

    protected array $queryParams = [];

    protected array $bodyParams = ['payload'];

    protected string $method = 'POST';

    protected string $path = '/api/v1/expenses';

    protected string $toolName = 'invoiceninja_create_expense';

    protected string $toolDescription = 'Create an Invoice Ninja expense.';
}

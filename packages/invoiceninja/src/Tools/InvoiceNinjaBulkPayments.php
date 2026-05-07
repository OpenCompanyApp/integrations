<?php

namespace OpenCompany\Integrations\InvoiceNinja\Tools;

/**
 * Run a documented bulk action against Invoice Ninja payments.
 */
class InvoiceNinjaBulkPayments extends AbstractInvoiceNinjaEndpointTool
{
    protected array $parameters = [
            'payload' => ['type' => 'object', 'required' => true, 'description' => 'Request payload matching the Invoice Ninja API schema for this endpoint.'],
    ];

    protected array $required = ['payload'];

    protected array $queryParams = [];

    protected array $bodyParams = ['payload'];

    protected string $method = 'POST';

    protected string $path = '/api/v1/payments/bulk';

    protected string $toolName = 'invoiceninja_bulk_payments';

    protected string $toolDescription = 'Run a documented bulk action against Invoice Ninja payments.';
}

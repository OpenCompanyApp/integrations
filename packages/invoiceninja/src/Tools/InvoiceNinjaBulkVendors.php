<?php

namespace OpenCompany\Integrations\InvoiceNinja\Tools;

/**
 * Run a documented bulk action against Invoice Ninja vendors.
 */
class InvoiceNinjaBulkVendors extends AbstractInvoiceNinjaEndpointTool
{
    protected array $parameters = [
            'payload' => ['type' => 'object', 'required' => true, 'description' => 'Request payload matching the Invoice Ninja API schema for this endpoint.'],
    ];

    protected array $required = ['payload'];

    protected array $queryParams = [];

    protected array $bodyParams = ['payload'];

    protected string $method = 'POST';

    protected string $path = '/api/v1/vendors/bulk';

    protected string $toolName = 'invoiceninja_bulk_vendors';

    protected string $toolDescription = 'Run a documented bulk action against Invoice Ninja vendors.';
}

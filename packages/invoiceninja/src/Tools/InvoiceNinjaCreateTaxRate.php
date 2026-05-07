<?php

namespace OpenCompany\Integrations\InvoiceNinja\Tools;

/**
 * Create an Invoice Ninja tax rate.
 */
class InvoiceNinjaCreateTaxRate extends AbstractInvoiceNinjaEndpointTool
{
    protected array $parameters = [
            'payload' => ['type' => 'object', 'required' => true, 'description' => 'Request payload matching the Invoice Ninja API schema for this endpoint.'],
    ];

    protected array $required = ['payload'];

    protected array $queryParams = [];

    protected array $bodyParams = ['payload'];

    protected string $method = 'POST';

    protected string $path = '/api/v1/tax_rates';

    protected string $toolName = 'invoiceninja_create_tax_rate';

    protected string $toolDescription = 'Create an Invoice Ninja tax rate.';
}

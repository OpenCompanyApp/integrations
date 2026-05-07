<?php

namespace OpenCompany\Integrations\InvoiceNinja\Tools;

/**
 * Update an Invoice Ninja tax rate by ID.
 */
class InvoiceNinjaUpdateTaxRate extends AbstractInvoiceNinjaEndpointTool
{
    protected array $parameters = [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Resource hashed ID.'],
            'payload' => ['type' => 'object', 'required' => true, 'description' => 'Request payload matching the Invoice Ninja API schema for this endpoint.'],
    ];

    protected array $required = ['id', 'payload'];

    protected array $queryParams = [];

    protected array $bodyParams = ['payload'];

    protected string $method = 'PUT';

    protected string $path = '/api/v1/tax_rates/{id}';

    protected string $toolName = 'invoiceninja_update_tax_rate';

    protected string $toolDescription = 'Update an Invoice Ninja tax rate by ID.';
}

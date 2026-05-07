<?php

namespace OpenCompany\Integrations\InvoiceNinja\Tools;

/**
 * Update an Invoice Ninja client. Mutating client requests should include child contacts when changing contact data.
 */
class InvoiceNinjaUpdateClient extends AbstractInvoiceNinjaEndpointTool
{
    protected array $parameters = [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Resource hashed ID.'],
            'payload' => ['type' => 'object', 'required' => true, 'description' => 'Request payload matching the Invoice Ninja API schema for this endpoint.'],
    ];

    protected array $required = ['id', 'payload'];

    protected array $queryParams = [];

    protected array $bodyParams = ['payload'];

    protected string $method = 'PUT';

    protected string $path = '/api/v1/clients/{id}';

    protected string $toolName = 'invoiceninja_update_client';

    protected string $toolDescription = 'Update an Invoice Ninja client. Mutating client requests should include child contacts when changing contact data.';
}

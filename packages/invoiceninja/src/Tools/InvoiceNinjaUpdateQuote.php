<?php

namespace OpenCompany\Integrations\InvoiceNinja\Tools;

/**
 * Update an Invoice Ninja quote by ID.
 */
class InvoiceNinjaUpdateQuote extends AbstractInvoiceNinjaEndpointTool
{
    protected array $parameters = [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Resource hashed ID.'],
            'payload' => ['type' => 'object', 'required' => true, 'description' => 'Request payload matching the Invoice Ninja API schema for this endpoint.'],
    ];

    protected array $required = ['id', 'payload'];

    protected array $queryParams = [];

    protected array $bodyParams = ['payload'];

    protected string $method = 'PUT';

    protected string $path = '/api/v1/quotes/{id}';

    protected string $toolName = 'invoiceninja_update_quote';

    protected string $toolDescription = 'Update an Invoice Ninja quote by ID.';
}

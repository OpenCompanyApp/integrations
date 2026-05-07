<?php

namespace OpenCompany\Integrations\InvoiceNinja\Tools;

/**
 * Get a single Invoice Ninja client by ID.
 */
class InvoiceNinjaGetClient extends AbstractInvoiceNinjaEndpointTool
{
    protected array $parameters = [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Resource hashed ID.'],
            'include' => ['type' => 'string', 'description' => 'Comma-separated child relations to include.'],
    ];

    protected array $required = ['id'];

    protected array $queryParams = ['include'];

    protected array $bodyParams = [];

    protected string $method = 'GET';

    protected string $path = '/api/v1/clients/{id}';

    protected string $toolName = 'invoiceninja_get_client';

    protected string $toolDescription = 'Get a single Invoice Ninja client by ID.';
}

<?php

namespace OpenCompany\Integrations\InvoiceNinja\Tools;

/**
 * Get a single Invoice Ninja task by ID.
 */
class InvoiceNinjaGetTask extends AbstractInvoiceNinjaEndpointTool
{
    protected array $parameters = [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Resource hashed ID.'],
            'include' => ['type' => 'string', 'description' => 'Comma-separated child relations to include.'],
    ];

    protected array $required = ['id'];

    protected array $queryParams = ['include'];

    protected array $bodyParams = [];

    protected string $method = 'GET';

    protected string $path = '/api/v1/tasks/{id}';

    protected string $toolName = 'invoiceninja_get_task';

    protected string $toolDescription = 'Get a single Invoice Ninja task by ID.';
}

<?php

namespace OpenCompany\Integrations\InvoiceNinja\Tools;

/**
 * Run a documented bulk action against Invoice Ninja projects.
 */
class InvoiceNinjaBulkProjects extends AbstractInvoiceNinjaEndpointTool
{
    protected array $parameters = [
            'payload' => ['type' => 'object', 'required' => true, 'description' => 'Request payload matching the Invoice Ninja API schema for this endpoint.'],
    ];

    protected array $required = ['payload'];

    protected array $queryParams = [];

    protected array $bodyParams = ['payload'];

    protected string $method = 'POST';

    protected string $path = '/api/v1/projects/bulk';

    protected string $toolName = 'invoiceninja_bulk_projects';

    protected string $toolDescription = 'Run a documented bulk action against Invoice Ninja projects.';
}

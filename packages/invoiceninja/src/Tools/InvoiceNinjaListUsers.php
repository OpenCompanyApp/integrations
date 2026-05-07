<?php

namespace OpenCompany\Integrations\InvoiceNinja\Tools;

/**
 * List Invoice Ninja users.
 */
class InvoiceNinjaListUsers extends AbstractInvoiceNinjaEndpointTool
{
    protected array $parameters = [
            'per_page' => ['type' => 'integer', 'description' => 'Number of records per page.'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination.'],
            'sort' => ['type' => 'string', 'description' => 'Sort expression such as name|desc.'],
            'include' => ['type' => 'string', 'description' => 'Comma-separated child relations to include.'],
            'search' => ['type' => 'string', 'description' => 'Search text or API-supported search filter.'],
    ];

    protected array $required = [];

    protected array $queryParams = ['per_page', 'page', 'sort', 'include', 'search'];

    protected array $bodyParams = [];

    protected string $method = 'GET';

    protected string $path = '/api/v1/users';

    protected string $toolName = 'invoiceninja_list_users';

    protected string $toolDescription = 'List Invoice Ninja users.';
}

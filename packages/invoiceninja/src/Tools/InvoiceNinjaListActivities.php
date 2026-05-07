<?php

namespace OpenCompany\Integrations\InvoiceNinja\Tools;

/**
 * List Invoice Ninja account activities.
 */
class InvoiceNinjaListActivities extends AbstractInvoiceNinjaEndpointTool
{
    protected array $parameters = [
            'per_page' => ['type' => 'integer', 'description' => 'Number of records per page.'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination.'],
            'sort' => ['type' => 'string', 'description' => 'Sort expression such as name|desc.'],
            'include' => ['type' => 'string', 'description' => 'Comma-separated child relations to include.'],
            'client_id' => ['type' => 'string', 'description' => 'Filter by client hashed ID when supported.'],
            'user_id' => ['type' => 'string', 'description' => 'Filter by user hashed ID when supported.'],
    ];

    protected array $required = [];

    protected array $queryParams = ['per_page', 'page', 'sort', 'include', 'client_id', 'user_id'];

    protected array $bodyParams = [];

    protected string $method = 'GET';

    protected string $path = '/api/v1/activities';

    protected string $toolName = 'invoiceninja_list_activities';

    protected string $toolDescription = 'List Invoice Ninja account activities.';
}

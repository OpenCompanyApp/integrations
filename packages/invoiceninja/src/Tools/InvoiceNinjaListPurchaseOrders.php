<?php

namespace OpenCompany\Integrations\InvoiceNinja\Tools;

/**
 * List Invoice Ninja purchase orders with optional filters and pagination.
 */
class InvoiceNinjaListPurchaseOrders extends AbstractInvoiceNinjaEndpointTool
{
    protected array $parameters = [
            'per_page' => ['type' => 'integer', 'description' => 'Number of records per page.'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination.'],
            'sort' => ['type' => 'string', 'description' => 'Sort expression such as name|desc.'],
            'include' => ['type' => 'string', 'description' => 'Comma-separated child relations to include.'],
            'search' => ['type' => 'string', 'description' => 'Search text or API-supported search filter.'],
            'is_deleted' => ['type' => 'boolean', 'description' => 'Include or filter deleted records when supported.'],
            'client_id' => ['type' => 'string', 'description' => 'Filter by client hashed ID when supported.'],
            'vendor_id' => ['type' => 'string', 'description' => 'Filter by vendor hashed ID when supported.'],
            'project_id' => ['type' => 'string', 'description' => 'Filter by project hashed ID when supported.'],
    ];

    protected array $required = [];

    protected array $queryParams = ['per_page', 'page', 'sort', 'include', 'search', 'is_deleted', 'client_id', 'vendor_id', 'project_id'];

    protected array $bodyParams = [];

    protected string $method = 'GET';

    protected string $path = '/api/v1/purchase_orders';

    protected string $toolName = 'invoiceninja_list_purchase_orders';

    protected string $toolDescription = 'List Invoice Ninja purchase orders with optional filters and pagination.';
}

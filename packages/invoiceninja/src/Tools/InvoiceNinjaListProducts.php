<?php

namespace OpenCompany\Integrations\InvoiceNinja\Tools;

use OpenCompany\Integrations\InvoiceNinja\InvoiceNinjaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: List Products.
 *
 * Lists products from Invoice Ninja with optional filtering and pagination.
 */
class InvoiceNinjaListProducts implements Tool
{
    /**
     * Create a new InvoiceNinjaListProducts tool instance.
     */
    public function __construct(
        private InvoiceNinjaService $service,
    ) {}

    /**
     * The tool identifier.
     */
    public function name(): string
    {
        return 'invoiceninja_list_products';
    }

    /**
     * Human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'List products from Invoice Ninja. Supports filtering by product key, custom value, and text search with pagination.';
    }

    /**
     * Define the parameters this tool accepts.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'per_page' => ['type' => 'integer', 'description' => 'Number of products per page (default: 20).'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination.'],
            'product_key' => ['type' => 'string', 'description' => 'Filter by product key (exact match).'],
            'sort' => ['type' => 'string', 'description' => 'Sort field (e.g. "product_key", "cost", "created_at").'],
            'is_deleted' => ['type' => 'boolean', 'description' => 'Include soft-deleted products.'],
        ];
    }

    /**
     * Execute the tool and return a result.
     *
     * @param  array<string, mixed>  $args
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Invoice Ninja integration is not configured.');
            }

            $params = array_filter([
                'per_page' => $args['per_page'] ?? null,
                'page' => $args['page'] ?? null,
                'product_key' => $args['product_key'] ?? null,
                'sort' => $args['sort'] ?? null,
                'is_deleted' => $args['is_deleted'] ?? null,
            ], fn ($value) => $value !== null);

            $result = $this->service->listProducts($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

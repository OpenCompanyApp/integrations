<?php

namespace OpenCompany\Integrations\Odoo\Tools;

use OpenCompany\Integrations\Odoo\OdooService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: List products from Odoo with pagination and optional filtering.
 *
 * Retrieves a paginated list of products (product.product) from the Odoo instance.
 * Supports filtering by name, category, type, and other fields.
 */
class OdooListProducts implements Tool
{
    /**
     * @param  OdooService  $service  The Odoo service instance for making API calls.
     */
    public function __construct(
        private OdooService $service,
    ) {}

    /**
     * Get the tool name used for registration and dispatch.
     */
    public function name(): string
    {
        return 'odoo_list_products';
    }

    /**
     * Get the human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'List products from Odoo with pagination. Filter by name, category, or type.';
    }

    /**
     * Get the parameter schema for this tool.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'limit' => ['type' => 'integer', 'description' => 'Number of products per page (default: 20, max: 100).'],
            'name' => ['type' => 'string', 'description' => 'Filter products by name (partial match).'],
            'category' => ['type' => 'string', 'description' => 'Filter by product category name.'],
            'type' => ['type' => 'string', 'description' => 'Filter by type: "consumable", "service", or "product".'],
            'sale_ok' => ['type' => 'boolean', 'description' => 'Filter to products that can be sold (true) or not (false).'],
            'purchase_ok' => ['type' => 'boolean', 'description' => 'Filter to products that can be purchased (true) or not (false).'],
        ];
    }

    /**
     * Execute the tool — fetch a paginated list of products from Odoo.
     *
     * @param  array<string, mixed>  $args  The tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Odoo integration is not configured.');
            }

            $page = isset($args['page']) ? (int) $args['page'] : 1;
            $limit = isset($args['limit']) ? min((int) $args['limit'], 100) : 20;

            $filters = [];
            foreach (['name', 'category', 'type', 'sale_ok', 'purchase_ok'] as $field) {
                if (isset($args[$field])) {
                    $filters[$field] = $args[$field];
                }
            }

            $result = $this->service->listProducts($page, $limit, $filters);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

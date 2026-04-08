<?php

namespace OpenCompany\Integrations\Paddle\Tools;

use OpenCompany\Integrations\Paddle\PaddleService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class PaddleListProducts implements Tool
{
    /**
     * Create a new PaddleListProducts tool instance.
     */
    public function __construct(
        private PaddleService $service,
    ) {}

    /**
     * Get the tool name.
     */
    public function name(): string
    {
        return 'paddle_list_products';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'List Paddle products. Supports filtering by status with cursor-based pagination.';
    }

    /**
     * Get the tool parameters.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of products to return per page (default: 50).'],
            'after' => ['type' => 'string', 'description' => 'Cursor for pagination — pass the value from a previous response to get the next page.'],
            'status' => ['type' => 'string', 'description' => 'Filter by product status: "active", "archived".'],
        ];
    }

    /**
     * Execute the tool.
     *
     * @param  array<string, mixed>  $args
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Paddle integration is not configured.');
            }

            $result = $this->service->listProducts(
                limit: isset($args['limit']) ? (int) $args['limit'] : null,
                after: $args['after'] ?? null,
                status: $args['status'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

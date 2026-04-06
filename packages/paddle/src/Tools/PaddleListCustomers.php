<?php

namespace OpenCompany\Integrations\Paddle\Tools;

use OpenCompany\Integrations\Paddle\PaddleService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class PaddleListCustomers implements Tool
{
    /**
     * Create a new PaddleListCustomers tool instance.
     */
    public function __construct(
        private PaddleService $service,
    ) {}

    /**
     * Get the tool name.
     */
    public function name(): string
    {
        return 'paddle_list_customers';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'List Paddle customers. Supports filtering by email and name, with cursor-based pagination.';
    }

    /**
     * Get the tool parameters.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of customers to return per page (default: 50).'],
            'after' => ['type' => 'string', 'description' => 'Cursor for pagination — pass the value from a previous response to get the next page.'],
            'email' => ['type' => 'string', 'description' => 'Filter customers by email address.'],
            'name' => ['type' => 'string', 'description' => 'Filter customers by name.'],
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

            $result = $this->service->listCustomers(
                limit: isset($args['limit']) ? (int) $args['limit'] : null,
                after: $args['after'] ?? null,
                email: $args['email'] ?? null,
                name: $args['name'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

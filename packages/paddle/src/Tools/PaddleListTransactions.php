<?php

namespace OpenCompany\Integrations\Paddle\Tools;

use OpenCompany\Integrations\Paddle\PaddleService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class PaddleListTransactions implements Tool
{
    /**
     * Create a new PaddleListTransactions tool instance.
     */
    public function __construct(
        private PaddleService $service,
    ) {}

    /**
     * Get the tool name.
     */
    public function name(): string
    {
        return 'paddle_list_transactions';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'List Paddle transactions. Supports filtering by status and customer ID, with cursor-based pagination.';
    }

    /**
     * Get the tool parameters.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of transactions to return per page (default: 50).'],
            'after' => ['type' => 'string', 'description' => 'Cursor for pagination — pass the value from a previous response to get the next page.'],
            'status' => ['type' => 'string', 'description' => 'Filter by transaction status: "completed", "pending", "billed", "paid", "canceled", "past_due".'],
            'customer_id' => ['type' => 'string', 'description' => 'Filter transactions by customer ID.'],
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

            $result = $this->service->listTransactions(
                limit: isset($args['limit']) ? (int) $args['limit'] : null,
                after: $args['after'] ?? null,
                status: $args['status'] ?? null,
                customerId: $args['customer_id'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

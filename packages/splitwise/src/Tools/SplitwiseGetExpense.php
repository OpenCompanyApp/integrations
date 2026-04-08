<?php

namespace OpenCompany\Integrations\Splitwise\Tools;

use OpenCompany\Integrations\Splitwise\SplitwiseService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * SplitwiseGetExpense — Retrieve a single expense by ID.
 *
 * Returns full expense details including cost, description, category,
 * date, group, comments, and the complete list of users involved with
 * their share amounts.
 *
 * @see https://dev.splitwise.com/#get_expense
 */
class SplitwiseGetExpense implements Tool
{
    /**
     * Create a new SplitwiseGetExpense tool instance.
     *
     * @param  SplitwiseService  $service  The Splitwise API service.
     */
    public function __construct(
        private SplitwiseService $service,
    ) {}

    /**
     * Get the tool name used for registration and invocation.
     *
     * @return string The tool identifier.
     */
    public function name(): string
    {
        return 'splitwise_get_expense';
    }

    /**
     * Get the tool description shown to AI agents.
     *
     * @return string A human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Get detailed information about a specific expense in Splitwise, including cost, description, category, date, and how it was split among users.';
    }

    /**
     * Get the tool parameter schema.
     *
     * @return array<string, array{type: string, required?: bool, description: string}> Parameter definitions.
     */
    public function parameters(): array
    {
        return [
            'id' => ['type' => 'integer', 'required' => true, 'description' => 'The expense ID to retrieve.'],
        ];
    }

    /**
     * Execute the get expense tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments containing the expense ID.
     * @return ToolResult The expense details or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Splitwise integration is not configured.');
            }

            if (!isset($args['id'])) {
                return ToolResult::error('Expense ID is required.');
            }

            $result = $this->service->getExpense((int) $args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

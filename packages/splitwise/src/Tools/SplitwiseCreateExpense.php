<?php

namespace OpenCompany\Integrations\Splitwise\Tools;

use OpenCompany\Integrations\Splitwise\SplitwiseService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * SplitwiseCreateExpense — Create a new shared expense.
 *
 * Creates an expense in Splitwise with a cost, description, and a list
 * of users who share the cost. Users are specified as an array of objects
 * with user_id and optional owed_share. If no owed_share is specified,
 * Splitwise splits the cost equally.
 *
 * @see https://dev.splitwise.com/#create_expense
 */
class SplitwiseCreateExpense implements Tool
{
    /**
     * Create a new SplitwiseCreateExpense tool instance.
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
        return 'splitwise_create_expense';
    }

    /**
     * Get the tool description shown to AI agents.
     *
     * @return string A human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Create a new shared expense in Splitwise. Specify the total cost, description, and users involved. The expense will be split equally unless custom owed_share amounts are provided per user.';
    }

    /**
     * Get the tool parameter schema.
     *
     * @return array<string, array{type: string, required?: bool, description: string}> Parameter definitions.
     */
    public function parameters(): array
    {
        return [
            'cost' => ['type' => 'string', 'required' => true, 'description' => 'Total cost of the expense (e.g., "45.50").'],
            'description' => ['type' => 'string', 'required' => true, 'description' => 'Description of the expense (e.g., "Dinner at Italian restaurant").'],
            'users' => ['type' => 'array', 'required' => true, 'description' => 'Array of users sharing the expense. Each user should have "user_id" (integer) and optionally "owed_share" (string, e.g., "22.75"). If owed_share is omitted, cost is split equally.'],
            'group_id' => ['type' => 'integer', 'description' => 'Group ID to assign the expense to.'],
            'currency_code' => ['type' => 'string', 'description' => 'Three-letter currency code (e.g., "USD", "EUR"). Defaults to the user\'s default currency.'],
            'date' => ['type' => 'string', 'description' => 'Date of the expense in ISO 8601 format (e.g., "2025-01-15"). Defaults to today.'],
            'category_id' => ['type' => 'integer', 'description' => 'Category ID for the expense (e.g., 18 for "Food", 9 for "Entertainment").'],
            'details' => ['type' => 'string', 'description' => 'Additional notes or details about the expense.'],
        ];
    }

    /**
     * Execute the create expense tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments containing cost, description, and users.
     * @return ToolResult The created expense data or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Splitwise integration is not configured.');
            }

            if (!isset($args['cost'])) {
                return ToolResult::error('Cost is required.');
            }

            if (!isset($args['description'])) {
                return ToolResult::error('Description is required.');
            }

            if (!isset($args['users']) || !is_array($args['users']) || empty($args['users'])) {
                return ToolResult::error('At least one user is required. Provide a "users" array with user_id entries.');
            }

            $data = [
                'cost' => (string) $args['cost'],
                'description' => $args['description'],
            ];

            // Build the users array for Splitwise API format
            foreach ($args['users'] as $i => $user) {
                if (!isset($user['user_id'])) {
                    return ToolResult::error("User at index {$i} is missing 'user_id'.");
                }
                $data["users__{$i}__user_id"] = (string) $user['user_id'];
                if (isset($user['owed_share'])) {
                    $data["users__{$i}__owed_share"] = (string) $user['owed_share'];
                }
            }

            $optionalFields = ['group_id', 'currency_code', 'date', 'category_id', 'details'];
            foreach ($optionalFields as $field) {
                if (isset($args[$field])) {
                    $data[$field] = $args[$field];
                }
            }

            $result = $this->service->createExpense($data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

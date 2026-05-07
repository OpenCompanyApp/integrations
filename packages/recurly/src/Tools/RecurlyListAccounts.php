<?php

namespace OpenCompany\Integrations\Recurly\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Recurly\RecurlyService;

/**
 * List Recurly billing accounts.
 *
 * Supports cursor pagination plus email and account-state filters.
 */
class RecurlyListAccounts implements Tool
{
    /**
     * Create a new RecurlyListAccounts tool instance.
     *
     * @param RecurlyService $service The Recurly API service.
     */
    public function __construct(
        private RecurlyService $service,
    ) {}

    /**
     * Get the tool name.
     *
     * @return string The tool identifier.
     */
    public function name(): string
    {
        return 'recurly_list_accounts';
    }

    /**
     * Get the tool description.
     *
     * @return string A human-readable description of what the tool does.
     */
    public function description(): string
    {
        return 'List billing accounts from Recurly. Supports filtering by email and state, with cursor-based pagination.';
    }

    /**
     * Get the tool parameters.
     *
     * @return array The parameter definitions keyed by name.
     */
    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of accounts to return (default: 20, max: 200).'],
            'cursor' => ['type' => 'string', 'description' => 'Cursor for pagination — pass the value from a previous response to get the next page.'],
            'email' => ['type' => 'string', 'description' => 'Filter accounts by email address.'],
            'state' => ['type' => 'string', 'description' => 'Filter by account state: "active", "closed", or "inactive".'],
        ];
    }

    /**
     * Execute the tool and return the result.
     *
     * @param array $args The tool arguments (limit, cursor, email, state).
     * @return ToolResult The result containing the list of accounts or an error.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Recurly integration is not configured.');
            }

            $result = $this->service->listAccounts(
                limit: isset($args['limit']) ? (int) $args['limit'] : null,
                cursor: $args['cursor'] ?? null,
                email: $args['email'] ?? null,
                state: $args['state'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

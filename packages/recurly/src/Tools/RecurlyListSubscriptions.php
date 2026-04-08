<?php

namespace OpenCompany\Integrations\Recurly\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Recurly\RecurlyService;

class RecurlyListSubscriptions implements Tool
{
    /**
     * Create a new RecurlyListSubscriptions tool instance.
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
        return 'recurly_list_subscriptions';
    }

    /**
     * Get the tool description.
     *
     * @return string A human-readable description of what the tool does.
     */
    public function description(): string
    {
        return 'List subscriptions from Recurly. Supports filtering by account and state, with cursor-based pagination.';
    }

    /**
     * Get the tool parameters.
     *
     * @return array The parameter definitions keyed by name.
     */
    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of subscriptions to return (default: 20, max: 200).'],
            'cursor' => ['type' => 'string', 'description' => 'Cursor for pagination — pass the value from a previous response to get the next page.'],
            'account_id' => ['type' => 'string', 'description' => 'Filter subscriptions by account ID or account code.'],
            'state' => ['type' => 'string', 'description' => 'Filter by subscription state: "active", "canceled", "expired", "future", "paused", or "trial".'],
        ];
    }

    /**
     * Execute the tool and return the result.
     *
     * @param array $args The tool arguments (limit, cursor, account_id, state).
     * @return ToolResult The result containing the list of subscriptions or an error.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Recurly integration is not configured.');
            }

            $result = $this->service->listSubscriptions(
                limit: isset($args['limit']) ? (int) $args['limit'] : null,
                cursor: $args['cursor'] ?? null,
                accountId: $args['account_id'] ?? null,
                state: $args['state'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

<?php

namespace OpenCompany\Integrations\HelpScout\Tools;

use OpenCompany\Integrations\HelpScout\HelpScoutService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class HelpScoutListConversations implements Tool
{
    /**
     * @param  HelpScoutService  $service  The HelpScout API service instance.
     */
    public function __construct(
        private HelpScoutService $service,
    ) {}

    /**
     * The tool identifier.
     */
    public function name(): string
    {
        return 'helpscout_list_conversations';
    }

    /**
     * A description of what the tool does, used by AI agents.
     */
    public function description(): string
    {
        return 'List support conversations from HelpScout. Supports filtering by mailbox, status, assignee, customer, and more. Returns paginated results.';
    }

    /**
     * Parameter schema for the tool.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'mailbox' => ['type' => 'integer', 'description' => 'Filter by mailbox ID.'],
            'status' => ['type' => 'string', 'description' => 'Filter by status: "open", "closed", "pending", "spam", "all". Defaults to "all".'],
            'assignee' => ['type' => 'integer', 'description' => 'Filter by assigned user ID. Use 0 for unassigned.'],
            'customer' => ['type' => 'integer', 'description' => 'Filter by customer ID.'],
            'tag' => ['type' => 'string', 'description' => 'Filter by tag name.'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'per_page' => ['type' => 'integer', 'description' => 'Number of results per page (default: 25, max: 50).'],
            'sort_field' => ['type' => 'string', 'description' => 'Sort field: "createdAt", "updatedAt", "customer.name", "subject", "status", "mailbox".'],
            'sort_order' => ['type' => 'string', 'description' => 'Sort direction: "asc" or "desc" (default: "desc").'],
            'query' => ['type' => 'string', 'description' => 'Search query to filter conversations by keyword.'],
        ];
    }

    /**
     * Execute the tool call.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return ToolResult
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('HelpScout integration is not configured.');
            }

            $params = array_filter([
                'mailbox' => $args['mailbox'] ?? null,
                'status' => $args['status'] ?? null,
                'assignee' => $args['assignee'] ?? null,
                'customer' => $args['customer'] ?? null,
                'tag' => $args['tag'] ?? null,
                'page' => $args['page'] ?? null,
                'per_page' => $args['per_page'] ?? null,
                'sortField' => $args['sort_field'] ?? null,
                'sortOrder' => $args['sort_order'] ?? null,
                'query' => $args['query'] ?? null,
            ], fn ($value) => $value !== null);

            $result = $this->service->listConversations($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

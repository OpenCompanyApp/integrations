<?php

namespace OpenCompany\Integrations\Front\Tools;

use OpenCompany\Integrations\Front\FrontService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class FrontListConversations implements Tool
{
    public function __construct(
        private FrontService $service,
    ) {}

    public function name(): string
    {
        return 'front_list_conversations';
    }

    public function description(): string
    {
        return 'List and search conversations in Front. Filter by status or search by keyword. Returns paginated results with conversation IDs, subjects, and metadata.';
    }

    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (1-based).'],
            'limit' => ['type' => 'integer', 'description' => 'Number of conversations per page (max 100).'],
            'status' => ['type' => 'string', 'description' => 'Filter by conversation status: open, archived, assigned, unassigned, starred, snoozed.'],
            'q' => ['type' => 'string', 'description' => 'Search query to filter conversations by subject, content, or contact.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Front integration is not configured.');
            }

            $result = $this->service->listConversations(
                page: isset($args['page']) ? (int) $args['page'] : null,
                limit: isset($args['limit']) ? (int) $args['limit'] : null,
                status: $args['status'] ?? null,
                q: $args['q'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

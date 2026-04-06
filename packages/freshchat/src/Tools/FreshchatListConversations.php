<?php

namespace OpenCompany\Integrations\Freshchat\Tools;

use OpenCompany\Integrations\Freshchat\FreshchatService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class FreshchatListConversations implements Tool
{
    public function __construct(
        private FreshchatService $service,
    ) {}

    public function name(): string
    {
        return 'freshchat_list_conversations';
    }

    public function description(): string
    {
        return 'List support conversations from Freshchat. Returns paginated results with optional filters for status and inbox. Use this to find recent or unresolved conversations.';
    }

    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'per_page' => ['type' => 'integer', 'description' => 'Number of conversations per page (default: 50, max: 100).'],
            'status' => ['type' => 'string', 'description' => 'Filter by conversation status. Possible values: "new", "open", "pending", "resolved", "closed".'],
            'inbox_id' => ['type' => 'string', 'description' => 'Filter conversations belonging to a specific inbox by its ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Freshchat integration is not configured.');
            }

            $page = isset($args['page']) ? (int) $args['page'] : 1;
            $perPage = isset($args['per_page']) ? (int) $args['per_page'] : 50;
            $status = $args['status'] ?? null;
            $inboxId = $args['inbox_id'] ?? null;

            $result = $this->service->listConversations($page, $perPage, $status, $inboxId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

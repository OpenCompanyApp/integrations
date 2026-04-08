<?php

namespace OpenCompany\Integrations\Lark\Tools;

use OpenCompany\Integrations\Lark\LarkService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class LarkListChats implements Tool
{
    public function __construct(
        private LarkService $service,
    ) {}

    public function name(): string
    {
        return 'lark_list_chats';
    }

    public function description(): string
    {
        return 'List chats the current authenticated user belongs to in Lark. Returns chat IDs, names, and metadata for use with other Lark tools.';
    }

    public function parameters(): array
    {
        return [
            'page_size' => ['type' => 'integer', 'description' => 'Number of chats to return per page (max 50, default 20).'],
            'page_token' => ['type' => 'string', 'description' => 'Pagination cursor from a previous response to fetch the next page.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Lark integration is not configured.');
            }

            $pageSize = isset($args['page_size']) ? (int) $args['page_size'] : 20;
            $pageToken = $args['page_token'] ?? null;

            $result = $this->service->listChats($pageSize, $pageToken);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

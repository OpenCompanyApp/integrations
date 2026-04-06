<?php

namespace OpenCompany\Integrations\Front\Tools;

use OpenCompany\Integrations\Front\FrontService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class FrontListInboxes implements Tool
{
    public function __construct(
        private FrontService $service,
    ) {}

    public function name(): string
    {
        return 'front_list_inboxes';
    }

    public function description(): string
    {
        return 'List all inboxes in the Front workspace. Returns inbox IDs, names, and types you can use to filter messages or get inbox details.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of inboxes to return per page (default: 50, max: 100).'],
            'cursor' => ['type' => 'string', 'description' => 'Pagination cursor — pass the next_cursor value from a previous response to fetch the next page.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Front integration is not configured.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 50;
            $cursor = $args['cursor'] ?? null;

            $result = $this->service->listInboxes($limit, $cursor);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

<?php

namespace OpenCompany\Integrations\Freshchat\Tools;

use OpenCompany\Integrations\Freshchat\FreshchatService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class FreshchatListGroups implements Tool
{
    public function __construct(
        private FreshchatService $service,
    ) {}

    public function name(): string
    {
        return 'freshchat_list_groups';
    }

    public function description(): string
    {
        return 'List support groups (teams) in Freshchat. Groups organize agents into teams for routing conversations.';
    }

    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'per_page' => ['type' => 'integer', 'description' => 'Number of groups per page (default: 50, max: 100).'],
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

            $result = $this->service->listGroups($page, $perPage);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

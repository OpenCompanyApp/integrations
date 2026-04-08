<?php

namespace OpenCompany\Integrations\Notion2\Tools;

use OpenCompany\Integrations\Notion2\NotionService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class NotionListUsers implements Tool
{
    public function __construct(private NotionService $service) {}

    public function name(): string { return 'notion2_list_users'; }
    public function description(): string { return 'List all users in your Notion workspace.'; }

    public function parameters(): array
    {
        return [
            'start_cursor' => ['type' => 'string',  'description' => 'Cursor for pagination from a previous response.'],
            'page_size'    => ['type' => 'integer', 'description' => 'Number of results per page (1–100, default 100).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) { return ToolResult::error('Notion integration is not configured.'); }
            $users = $this->service->listUsers();
            return ToolResult::success($users);
        } catch (\Throwable $e) { return ToolResult::error($e->getMessage()); }
    }
}

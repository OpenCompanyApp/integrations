<?php

namespace OpenCompany\Integrations\Notion2\Tools;

use OpenCompany\Integrations\Notion2\NotionService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class NotionGetCurrentUser implements Tool
{
    public function __construct(private NotionService $service) {}

    public function name(): string { return 'notion2_get_current_user'; }
    public function description(): string { return 'Get the currently authenticated Notion user/bot.'; }
    public function parameters(): array { return []; }

    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) { return ToolResult::error('Notion integration is not configured.'); }
            $user = $this->service->getCurrentUser();
            return ToolResult::success($user);
        } catch (\Throwable $e) { return ToolResult::error($e->getMessage()); }
    }
}

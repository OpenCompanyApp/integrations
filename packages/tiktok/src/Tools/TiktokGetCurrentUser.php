<?php

namespace OpenCompany\Integrations\TikTok\Tools;

use OpenCompany\Integrations\TikTok\TiktokService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class TiktokGetCurrentUser implements Tool
{
    public function __construct(
        private TiktokService $service,
    ) {}

    public function name(): string
    {
        return 'tiktok_get_current_user';
    }

    public function description(): string
    {
        return 'Get the authenticated user\'s TikTok Business account information, including display name, email, and status.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('TikTok integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

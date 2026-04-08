<?php

namespace OpenCompany\Integrations\QuickBase\Tools;

use OpenCompany\Integrations\QuickBase\QuickBaseService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class QuickBaseGetCurrentUser implements Tool
{
    public function __construct(
        private QuickBaseService $service,
    ) {}

    public function name(): string
    {
        return 'quickbase_get_current_user';
    }

    public function description(): string
    {
        return 'Get the currently authenticated QuickBase user. Returns user profile information including name, email, and user ID.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('QuickBase integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

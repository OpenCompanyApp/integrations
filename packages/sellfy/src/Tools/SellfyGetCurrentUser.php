<?php

namespace OpenCompany\Integrations\Sellfy\Tools;

use OpenCompany\Integrations\Sellfy\SellfyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class SellfyGetCurrentUser implements Tool
{
    public function __construct(
        private SellfyService $service,
    ) {}

    public function name(): string
    {
        return 'sellfy_get_current_user';
    }

    public function description(): string
    {
        return 'Get the currently authenticated Sellfy user profile. Useful for verifying API credentials and viewing account info.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Sellfy integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

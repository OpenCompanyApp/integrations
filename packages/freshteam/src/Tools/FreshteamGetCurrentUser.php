<?php

namespace OpenCompany\Integrations\Freshteam\Tools;

use OpenCompany\Integrations\Freshteam\FreshteamService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class FreshteamGetCurrentUser implements Tool
{
    public function __construct(
        private FreshteamService $service,
    ) {}

    public function name(): string
    {
        return 'freshteam_get_current_user';
    }

    public function description(): string
    {
        return 'Retrieve the profile of the currently authenticated Freshteam user. Useful for verifying the connection and identifying which account is active.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Freshteam integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

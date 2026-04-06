<?php

namespace OpenCompany\Integrations\Freshchat\Tools;

use OpenCompany\Integrations\Freshchat\FreshchatService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class FreshchatGetCurrentUser implements Tool
{
    public function __construct(
        private FreshchatService $service,
    ) {}

    public function name(): string
    {
        return 'freshchat_get_current_user';
    }

    public function description(): string
    {
        return 'Get the profile of the currently authenticated Freshchat user. Useful for verifying credentials and identifying the connected account.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Freshchat integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

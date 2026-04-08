<?php

namespace OpenCompany\Integrations\Unbounce\Tools;

use OpenCompany\Integrations\Unbounce\UnbounceService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class UnbounceGetCurrentUser implements Tool
{
    public function __construct(
        private UnbounceService $service,
    ) {}

    public function name(): string
    {
        return 'unbounce_get_current_user';
    }

    public function description(): string
    {
        return 'Get the currently authenticated Unbounce user profile. Returns account name, email, and other account details.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Unbounce integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

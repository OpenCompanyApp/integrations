<?php

namespace OpenCompany\Integrations\Drip\Tools;

use OpenCompany\Integrations\Drip\DripService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class DripGetCurrentUser implements Tool
{
    public function __construct(
        private DripService $service,
    ) {}

    public function name(): string
    {
        return 'drip_get_current_user';
    }

    public function description(): string
    {
        return 'Get the currently authenticated Drip user. Returns user profile information including name, email, and account details. Useful for verifying the API connection and identifying which account is active.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Drip integration is not configured. Provide an API key and account ID.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

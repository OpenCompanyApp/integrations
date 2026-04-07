<?php

namespace OpenCompany\Integrations\Neon\Tools;

use OpenCompany\Integrations\Neon\NeonService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class NeonGetCurrentUser implements Tool
{
    public function __construct(
        private NeonService $service,
    ) {}

    public function name(): string
    {
        return 'neon_get_current_user';
    }

    public function description(): string
    {
        return 'Get information about the current authenticated Neon user, including email, name, and organization membership.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Neon integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

<?php

namespace OpenCompany\Integrations\Hostinger\Tools;

use OpenCompany\Integrations\Hostinger\HostingerService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class HostingerGetCurrentUser implements Tool
{
    public function __construct(
        private HostingerService $service,
    ) {}

    public function name(): string
    {
        return 'hostinger_get_current_user';
    }

    public function description(): string
    {
        return 'Get information about the current authenticated Hostinger account, including email and user details.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Hostinger integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

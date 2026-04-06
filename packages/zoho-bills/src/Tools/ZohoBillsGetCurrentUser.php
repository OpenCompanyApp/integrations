<?php

namespace OpenCompany\Integrations\ZohoBills\Tools;

use OpenCompany\Integrations\ZohoBills\ZohoBillsService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class ZohoBillsGetCurrentUser implements Tool
{
    public function __construct(
        private ZohoBillsService $service,
    ) {}

    public function name(): string
    {
        return 'zoho_bills_get_current_user';
    }

    public function description(): string
    {
        return 'Get the currently authenticated Zoho Bills user profile. Useful for verifying connectivity and checking user permissions.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Zoho Bills integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

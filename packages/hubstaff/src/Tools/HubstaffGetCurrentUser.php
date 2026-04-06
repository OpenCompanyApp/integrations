<?php

namespace OpenCompany\Integrations\Hubstaff\Tools;

use OpenCompany\Integrations\Hubstaff\HubstaffService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class HubstaffGetCurrentUser implements Tool
{
    public function __construct(
        private HubstaffService $service,
    ) {}

    public function name(): string
    {
        return 'hubstaff_get_current_user';
    }

    public function description(): string
    {
        return 'Get the profile of the currently authenticated Hubstaff user. Returns name, email, timezone, and other account information.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Hubstaff integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

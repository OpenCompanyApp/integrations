<?php

namespace OpenCompany\Integrations\MicrosoftPowerBI\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\MicrosoftPowerBI\PowerBIService;

class PowerBIGetCurrentUser implements Tool
{
    public function __construct(
        private PowerBIService $service,
    ) {}

    public function name(): string
    {
        return 'powerbi_get_current_user';
    }

    public function description(): string
    {
        return 'Get the profile of the currently authenticated Power BI user. Returns display name, email address, and user identity details.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Power BI integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

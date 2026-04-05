<?php

namespace OpenCompany\Integrations\Airtop\Tools;

use OpenCompany\Integrations\Airtop\AirtopService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class AirtopGetCurrentUser implements Tool
{
    public function __construct(
        private AirtopService $service,
    ) {}

    public function name(): string
    {
        return 'airtop_get_current_user';
    }

    public function description(): string
    {
        return 'Get the profile of the currently authenticated Airtop user. Useful for verifying API credentials and checking account details.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Airtop integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

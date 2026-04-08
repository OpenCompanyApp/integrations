<?php

namespace OpenCompany\Integrations\Wildix\Tools;

use OpenCompany\Integrations\Wildix\WildixService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class WildixGetCurrentUser implements Tool
{
    public function __construct(
        private WildixService $service,
    ) {}

    public function name(): string
    {
        return 'wildix_get_current_user';
    }

    public function description(): string
    {
        return 'Get the profile of the currently authenticated Wildix user (the user associated with the configured access token).';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Wildix integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

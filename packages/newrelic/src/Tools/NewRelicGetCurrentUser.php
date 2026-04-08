<?php

namespace OpenCompany\Integrations\NewRelic\Tools;

use OpenCompany\Integrations\NewRelic\NewRelicService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class NewRelicGetCurrentUser implements Tool
{
    public function __construct(
        private NewRelicService $service,
    ) {}

    public function name(): string
    {
        return 'newrelic_get_current_user';
    }

    public function description(): string
    {
        return 'Get the profile of the currently authenticated New Relic user. Useful for verifying API credentials and retrieving account information.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('New Relic integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

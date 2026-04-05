<?php

namespace OpenCompany\Integrations\Splunk\Tools;

use OpenCompany\Integrations\Splunk\SplunkService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class SplunkGetCurrentUser implements Tool
{
    public function __construct(
        private SplunkService $service,
    ) {}

    public function name(): string
    {
        return 'splunk_get_current_user';
    }

    public function description(): string
    {
        return 'Get the current authenticated Splunk user context. Returns username, roles, capabilities, and tenant information.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Splunk integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

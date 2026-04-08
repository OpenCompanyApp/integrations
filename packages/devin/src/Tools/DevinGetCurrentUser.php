<?php

namespace OpenCompany\Integrations\Devin\Tools;

use OpenCompany\Integrations\Devin\DevinService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class DevinGetCurrentUser implements Tool
{
    public function __construct(
        private DevinService $service,
    ) {}

    public function name(): string
    {
        return 'devin_get_current_user';
    }

    public function description(): string
    {
        return 'Get information about the currently authenticated Devin user. Use this to verify the API connection and identify which account is being used.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Devin integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

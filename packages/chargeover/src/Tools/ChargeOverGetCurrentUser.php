<?php

namespace OpenCompany\Integrations\ChargeOver\Tools;

use OpenCompany\Integrations\ChargeOver\ChargeOverService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class ChargeOverGetCurrentUser implements Tool
{
    public function __construct(
        private ChargeOverService $service,
    ) {}

    public function name(): string
    {
        return 'chargeover_get_current_user';
    }

    public function description(): string
    {
        return 'Get information about the currently authenticated ChargeOver user and account. Useful for verifying connectivity and understanding which account the integration is connected to.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('ChargeOver integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

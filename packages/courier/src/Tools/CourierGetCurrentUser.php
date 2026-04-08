<?php

namespace OpenCompany\Integrations\Courier\Tools;

use OpenCompany\Integrations\Courier\CourierService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class CourierGetCurrentUser implements Tool
{
    public function __construct(
        private CourierService $service,
    ) {}

    public function name(): string
    {
        return 'courier_get_current_user';
    }

    public function description(): string
    {
        return 'Get the currently authenticated Courier user profile. Use this to verify the API key and see account information.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Courier integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

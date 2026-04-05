<?php

namespace OpenCompany\Integrations\CustomerIO\Tools;

use OpenCompany\Integrations\CustomerIO\CustomerIOService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class CustomerIOGetCurrentUser implements Tool
{
    public function __construct(
        private CustomerIOService $service,
    ) {}

    public function name(): string
    {
        return 'customerio_get_current_user';
    }

    public function description(): string
    {
        return 'Get the currently authenticated user and account information from Customer.io. Useful for verifying API credentials and checking workspace details.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Customer.io integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

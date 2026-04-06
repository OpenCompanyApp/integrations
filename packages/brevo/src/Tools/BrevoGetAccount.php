<?php

namespace OpenCompany\Integrations\Brevo\Tools;

use OpenCompany\Integrations\Brevo\BrevoService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class BrevoGetAccount implements Tool
{
    public function __construct(
        private BrevoService $service,
    ) {}

    public function name(): string
    {
        return 'brevo_get_account';
    }

    public function description(): string
    {
        return 'Get information about the connected Brevo account, including email, plan details, and account statistics.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Brevo integration is not configured.');
            }

            $result = $this->service->getAccount();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

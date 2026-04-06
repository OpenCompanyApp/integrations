<?php

namespace OpenCompany\Integrations\ChartMogul\Tools;

use OpenCompany\Integrations\ChartMogul\ChartMogulService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class ChartMogulGetCurrentUser implements Tool
{
    public function __construct(
        private ChartMogulService $service,
    ) {}

    public function name(): string
    {
        return 'chartmogul_get_current_user';
    }

    public function description(): string
    {
        return 'Get the currently authenticated ChartMogul user. Returns user details including name, email, and account information. Useful for verifying API credentials.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('ChartMogul integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

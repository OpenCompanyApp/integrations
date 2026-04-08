<?php

namespace OpenCompany\Integrations\Avalara\Tools;

use OpenCompany\Integrations\Avalara\AvalaraService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class AvalaraGetCurrentUser implements Tool
{
    public function __construct(
        private AvalaraService $service,
    ) {}

    public function name(): string { return 'avalara_get_current_user'; }

    public function description(): string
    {
        return 'Retrieve the current authenticated Avalara user information.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Avalara integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

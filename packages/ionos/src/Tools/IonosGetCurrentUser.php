<?php

namespace OpenCompany\Integrations\Ionos\Tools;

use OpenCompany\Integrations\Ionos\IonosService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class IonosGetCurrentUser implements Tool
{
    public function __construct(
        private IonosService $service,
    ) {}

    public function name(): string
    {
        return 'ionos_get_current_user';
    }

    public function description(): string
    {
        return 'Get information about the current authenticated IONOS Cloud user, including email, name, and account status.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('IONOS integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

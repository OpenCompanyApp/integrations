<?php

namespace OpenCompany\Integrations\Abyssale\Tools;

use OpenCompany\Integrations\Abyssale\AbyssaleService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class AbyssaleGetCurrentUser implements Tool
{
    public function __construct(
        private AbyssaleService $service,
    ) {}

    public function name(): string
    {
        return 'abyssale_get_current_user';
    }

    public function description(): string
    {
        return 'Get the profile of the currently authenticated Abyssale user. Useful for verifying API credentials and retrieving account information.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Abyssale integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

<?php

namespace OpenCompany\Integrations\Granola\Tools;

use OpenCompany\Integrations\Granola\GranolaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class GranolaGetCurrentUser implements Tool
{
    public function __construct(
        private GranolaService $service,
    ) {}

    public function name(): string
    {
        return 'granola_get_current_user';
    }

    public function description(): string
    {
        return 'Get the profile of the currently authenticated Granola user. Returns name, email, and account details.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Granola integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

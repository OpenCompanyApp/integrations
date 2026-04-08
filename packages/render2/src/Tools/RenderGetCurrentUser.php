<?php

namespace OpenCompany\Integrations\Render2\Tools;

use OpenCompany\Integrations\Render2\RenderService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class RenderGetCurrentUser implements Tool
{
    public function __construct(
        private RenderService $service,
    ) {}

    public function name(): string
    {
        return 'render_get_current_user';
    }

    public function description(): string
    {
        return 'Get information about the current authenticated Render account, including email, name, and plan.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Render integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

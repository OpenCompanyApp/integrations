<?php

namespace OpenCompany\Integrations\Raindrop\Tools;

use OpenCompany\Integrations\Raindrop\RaindropService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class RaindropGetCurrentUser implements Tool
{
    public function __construct(
        private RaindropService $service,
    ) {}

    public function name(): string
    {
        return 'raindrop_get_current_user';
    }

    public function description(): string
    {
        return 'Get the authenticated Raindrop.io user\'s profile — name, email, subscription plan, and storage usage.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Raindrop.io integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

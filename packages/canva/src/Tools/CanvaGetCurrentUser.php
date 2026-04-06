<?php

namespace OpenCompany\Integrations\Canva\Tools;

use OpenCompany\Integrations\Canva\CanvaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class CanvaGetCurrentUser implements Tool
{
    public function __construct(
        private CanvaService $service,
    ) {}

    public function name(): string
    {
        return 'canva_get_current_user';
    }

    public function description(): string
    {
        return 'Get the authenticated Canva user\'s profile information, including display name and user ID.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Canva integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

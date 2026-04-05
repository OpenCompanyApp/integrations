<?php

namespace OpenCompany\Integrations\Line\Tools;

use OpenCompany\Integrations\Line\LineService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class LineGetCurrentUser implements Tool
{
    public function __construct(
        private LineService $service,
    ) {}

    public function name(): string
    {
        return 'line_get_current_user';
    }

    public function description(): string
    {
        return 'Get the profile of the LINE Official Account (bot) itself, including display name, icon URL, and basic info.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('LINE integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

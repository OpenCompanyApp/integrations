<?php

namespace OpenCompany\Integrations\Droplr\Tools;

use OpenCompany\Integrations\Droplr\DroplrService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class DroplrGetCurrentUser implements Tool
{
    public function __construct(
        private DroplrService $service,
    ) {}

    public function name(): string
    {
        return 'droplr_get_current_user';
    }

    public function description(): string
    {
        return 'Get the authenticated Droplr user\'s profile, including name, email, and plan information.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Droplr integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

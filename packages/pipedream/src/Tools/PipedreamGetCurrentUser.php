<?php

namespace OpenCompany\Integrations\Pipedream\Tools;

use OpenCompany\Integrations\Pipedream\PipedreamService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class PipedreamGetCurrentUser implements Tool
{
    public function __construct(
        private PipedreamService $service,
    ) {}

    public function name(): string
    {
        return 'pipedream_get_current_user';
    }

    public function description(): string
    {
        return 'Get the currently authenticated Pipedream user profile, including name, email, and workspace details.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Pipedream integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

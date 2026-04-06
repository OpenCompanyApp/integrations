<?php

namespace OpenCompany\Integrations\Dub\Tools;

use OpenCompany\Integrations\Dub\DubService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class DubGetCurrentUser implements Tool
{
    public function __construct(
        private DubService $service,
    ) {}

    public function name(): string
    {
        return 'dub_get_current_user';
    }

    public function description(): string
    {
        return 'Get the profile of the currently authenticated Dub.co user. Useful for verifying the connection and checking workspace membership.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Dub.co integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

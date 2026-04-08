<?php

namespace OpenCompany\Integrations\Novu\Tools;

use OpenCompany\Integrations\Novu\NovuService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class NovuGetCurrentUser implements Tool
{
    public function __construct(
        private NovuService $service,
    ) {}

    public function name(): string
    {
        return 'novu_get_current_user';
    }

    public function description(): string
    {
        return 'Get the currently authenticated Novu user. Returns user profile information including name, email, and organization details.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Novu integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

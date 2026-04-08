<?php

namespace OpenCompany\Integrations\Nifty\Tools;

use OpenCompany\Integrations\Nifty\NiftyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class NiftyGetCurrentUser implements Tool
{
    public function __construct(
        private NiftyService $service,
    ) {}

    public function name(): string
    {
        return 'nifty_get_current_user';
    }

    public function description(): string
    {
        return 'Get the profile of the currently authenticated Nifty user, including name, email, and workspace membership.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Nifty integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

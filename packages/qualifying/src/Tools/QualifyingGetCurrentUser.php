<?php

namespace OpenCompany\Integrations\Qualifying\Tools;

use OpenCompany\Integrations\Qualifying\QualifyingService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class QualifyingGetCurrentUser implements Tool
{
    public function __construct(
        private QualifyingService $service,
    ) {}

    public function name(): string
    {
        return 'qualifying_get_current_user';
    }

    public function description(): string
    {
        return 'Get the profile of the currently authenticated Qualifying user. Returns user details such as name, email, and role. Useful for verifying the connection and understanding whose credentials are being used.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Qualifying integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

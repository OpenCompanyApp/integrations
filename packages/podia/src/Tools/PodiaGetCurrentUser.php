<?php

namespace OpenCompany\Integrations\Podia\Tools;

use OpenCompany\Integrations\Podia\PodiaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class PodiaGetCurrentUser implements Tool
{
    public function __construct(
        private PodiaService $service,
    ) {}

    public function name(): string
    {
        return 'podia_get_current_user';
    }

    public function description(): string
    {
        return 'Get the profile of the currently authenticated Podia user. Useful to verify the connection and see account details.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Podia integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            $user = $result['user'] ?? $result;

            return ToolResult::success($user);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

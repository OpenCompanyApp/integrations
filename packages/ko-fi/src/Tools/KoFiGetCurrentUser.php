<?php

namespace OpenCompany\Integrations\KoFi\Tools;

use OpenCompany\Integrations\KoFi\KoFiService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class KoFiGetCurrentUser implements Tool
{
    public function __construct(
        private KoFiService $service,
    ) {}

    public function name(): string
    {
        return 'ko-fi_get_current_user';
    }

    public function description(): string
    {
        return 'Get the profile of the currently authenticated Ko-fi user. Useful to verify the connection and see account details.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Ko-fi integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            $user = $result['user'] ?? $result;

            return ToolResult::success($user);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

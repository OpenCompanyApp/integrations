<?php

namespace OpenCompany\Integrations\Kajabi\Tools;

use OpenCompany\Integrations\Kajabi\KajabiService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class KajabiGetCurrentUser implements Tool
{
    public function __construct(
        private KajabiService $service,
    ) {}

    public function name(): string
    {
        return 'kajabi_get_current_user';
    }

    public function description(): string
    {
        return 'Get the profile of the currently authenticated Kajabi user. Useful to verify the connection and see account details.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Kajabi integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            $user = $result['user'] ?? $result['data'] ?? $result;

            return ToolResult::success($user);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

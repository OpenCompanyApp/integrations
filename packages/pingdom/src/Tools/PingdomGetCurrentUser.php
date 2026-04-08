<?php

namespace OpenCompany\Integrations\Pingdom\Tools;

use OpenCompany\Integrations\Pingdom\PingdomService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class PingdomGetCurrentUser implements Tool
{
    public function __construct(
        private PingdomService $service,
    ) {}

    public function name(): string
    {
        return 'pingdom_get_current_user';
    }

    public function description(): string
    {
        return 'Get details of the currently authenticated Pingdom user, including account info and credits.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Pingdom integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            $user = $result['account'] ?? $result['member'] ?? $result;

            return ToolResult::success($user);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

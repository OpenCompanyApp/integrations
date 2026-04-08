<?php

namespace OpenCompany\Integrations\Freshmarketer\Tools;

use OpenCompany\Integrations\Freshmarketer\FreshmarketerService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * FreshmarketerListUsers — list users in the Freshmarketer account.
 *
 * Calls POST /api/v1/users to retrieve the user list.
 */
class FreshmarketerListUsers implements Tool
{
    public function __construct(
        private FreshmarketerService $service,
    ) {}

    public function name(): string
    {
        return 'freshmarketer_list_users';
    }

    public function description(): string
    {
        return 'List all users in the Freshmarketer account.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Freshmarketer integration is not configured.');
            }

            $result = $this->service->listUsers();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

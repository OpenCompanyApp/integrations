<?php

namespace OpenCompany\Integrations\MySQL\Tools;

use OpenCompany\Integrations\MySQL\MySQLService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get the currently authenticated MySQL user via the ping endpoint.
 */
class MySQLGetCurrentUser implements Tool
{
    public function __construct(
        private MySQLService $service,
    ) {}

    public function name(): string
    {
        return 'mysql_get_current_user';
    }

    public function description(): string
    {
        return 'Get information about the currently authenticated MySQL user. Useful for verifying credentials and connection status.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('MySQL integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

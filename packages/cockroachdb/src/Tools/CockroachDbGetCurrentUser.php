<?php

namespace OpenCompany\Integrations\CockroachDb\Tools;

use OpenCompany\Integrations\CockroachDb\CockroachDbService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class CockroachDbGetCurrentUser implements Tool
{
    public function __construct(
        private CockroachDbService $service,
    ) {}

    public function name(): string
    {
        return 'cockroachdb_get_current_user';
    }

    public function description(): string
    {
        return 'Get information about the current authenticated CockroachDB Cloud user, including email, name, and organization role.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('CockroachDB integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

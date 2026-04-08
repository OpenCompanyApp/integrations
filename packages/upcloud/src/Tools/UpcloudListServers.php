<?php

namespace OpenCompany\Integrations\Upcloud\Tools;

use OpenCompany\Integrations\Upcloud\UpcloudService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List all cloud servers on the UpCloud account.
 *
 * Returns a list of all servers including their UUIDs, names,
 * states, and basic configuration details.
 */
class UpcloudListServers implements Tool
{
    public function __construct(
        private UpcloudService $service,
    ) {}

    public function name(): string
    {
        return 'upcloud_list_servers';
    }

    public function description(): string
    {
        return 'List all cloud servers on the UpCloud account.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('UpCloud integration is not configured.');
            }

            $result = $this->service->listServers();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

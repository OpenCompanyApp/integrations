<?php

namespace OpenCompany\Integrations\Hostinger\Tools;

use OpenCompany\Integrations\Hostinger\HostingerService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class HostingerListServers implements Tool
{
    public function __construct(
        private HostingerService $service,
    ) {}

    public function name(): string
    {
        return 'hostinger_list_servers';
    }

    public function description(): string
    {
        return 'List all VPS servers in the Hostinger account. Returns server IDs, names, status, plan, and IP addresses.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Hostinger integration is not configured.');
            }

            $result = $this->service->listServers();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

<?php

namespace OpenCompany\Integrations\Hostinger\Tools;

use OpenCompany\Integrations\Hostinger\HostingerService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class HostingerListDomains implements Tool
{
    public function __construct(
        private HostingerService $service,
    ) {}

    public function name(): string
    {
        return 'hostinger_list_domains';
    }

    public function description(): string
    {
        return 'List all domains in the Hostinger account. Returns domain IDs, names, and status.';
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

            $result = $this->service->listDomains();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

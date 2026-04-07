<?php

namespace OpenCompany\Integrations\Vultr\Tools;

use OpenCompany\Integrations\Vultr\VultrService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class VultrListSshKeys implements Tool
{
    public function __construct(
        private VultrService $service,
    ) {}

    public function name(): string
    {
        return 'vultr_list_ssh_keys';
    }

    public function description(): string
    {
        return 'List all SSH keys in the Vultr account. Returns key IDs, names, and creation dates.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Vultr integration is not configured.');
            }

            $result = $this->service->listSshKeys();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

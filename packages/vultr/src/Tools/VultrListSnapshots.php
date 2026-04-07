<?php

namespace OpenCompany\Integrations\Vultr\Tools;

use OpenCompany\Integrations\Vultr\VultrService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class VultrListSnapshots implements Tool
{
    public function __construct(
        private VultrService $service,
    ) {}

    public function name(): string
    {
        return 'vultr_list_snapshots';
    }

    public function description(): string
    {
        return 'List all snapshots in the Vultr account. Returns snapshot IDs, descriptions, sizes, creation dates, and status.';
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

            $result = $this->service->listSnapshots();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

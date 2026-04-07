<?php

namespace OpenCompany\Integrations\Vultr\Tools;

use OpenCompany\Integrations\Vultr\VultrService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class VultrListRegions implements Tool
{
    public function __construct(
        private VultrService $service,
    ) {}

    public function name(): string
    {
        return 'vultr_list_regions';
    }

    public function description(): string
    {
        return 'List all available data center regions in Vultr. Returns region IDs, city, country, and continent information.';
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

            $result = $this->service->listRegions();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

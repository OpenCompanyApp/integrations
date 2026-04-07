<?php

namespace OpenCompany\Integrations\Kamatera\Tools;

use OpenCompany\Integrations\Kamatera\KamateraService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class KamateraListDatacenters implements Tool
{
    public function __construct(
        private KamateraService $service,
    ) {}

    public function name(): string
    {
        return 'kamatera_list_datacenters';
    }

    public function description(): string
    {
        return 'List all available Kamatera datacenter locations. Returns datacenter IDs, names, city, and country.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Kamatera integration is not configured.');
            }

            $result = $this->service->listDatacenters();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

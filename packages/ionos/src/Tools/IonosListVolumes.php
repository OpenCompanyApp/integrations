<?php

namespace OpenCompany\Integrations\Ionos\Tools;

use OpenCompany\Integrations\Ionos\IonosService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class IonosListVolumes implements Tool
{
    public function __construct(
        private IonosService $service,
    ) {}

    public function name(): string
    {
        return 'ionos_list_volumes';
    }

    public function description(): string
    {
        return 'List all block storage volumes in the IONOS Cloud account. Returns IDs, names, size, type, zone, and state.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('IONOS integration is not configured.');
            }

            $result = $this->service->listVolumes();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

<?php

namespace OpenCompany\Integrations\Upcloud\Tools;

use OpenCompany\Integrations\Upcloud\UpcloudService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List available UpCloud zones (data centers).
 *
 * Returns a list of all available zones where servers and
 * storage can be provisioned.
 */
class UpcloudListZones implements Tool
{
    public function __construct(
        private UpcloudService $service,
    ) {}

    public function name(): string
    {
        return 'upcloud_list_zones';
    }

    public function description(): string
    {
        return 'List available UpCloud zones (data centers).';
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

            $result = $this->service->listZones();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

<?php

namespace OpenCompany\Integrations\Upcloud\Tools;

use OpenCompany\Integrations\Upcloud\UpcloudService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List private networks on the UpCloud account.
 *
 * Returns a list of all private networks including their UUIDs,
 * names, zones, and attached servers.
 */
class UpcloudListNetworks implements Tool
{
    public function __construct(
        private UpcloudService $service,
    ) {}

    public function name(): string
    {
        return 'upcloud_list_networks';
    }

    public function description(): string
    {
        return 'List private networks on the UpCloud account.';
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

            $result = $this->service->listNetworks();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

<?php

namespace OpenCompany\Integrations\Upcloud\Tools;

use OpenCompany\Integrations\Upcloud\UpcloudService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List storage devices on the UpCloud account.
 *
 * Returns a list of storage devices. Optionally filter by type
 * (e.g., "disk", "backup", "cdrom").
 */
class UpcloudListStorages implements Tool
{
    public function __construct(
        private UpcloudService $service,
    ) {}

    public function name(): string
    {
        return 'upcloud_list_storages';
    }

    public function description(): string
    {
        return 'List storage devices on the UpCloud account. Optionally filter by type (disk, backup, cdrom).';
    }

    public function parameters(): array
    {
        return [
            'type' => ['type' => 'string', 'description' => 'Storage type filter: "disk", "backup", or "cdrom".'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('UpCloud integration is not configured.');
            }

            $type = isset($args['type']) ? (string) $args['type'] : '';

            $result = $this->service->listStorages($type);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

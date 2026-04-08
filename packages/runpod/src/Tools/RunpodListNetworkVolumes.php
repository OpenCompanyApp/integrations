<?php

namespace OpenCompany\Integrations\Runpod\Tools;

use OpenCompany\Integrations\Runpod\RunpodService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List all network volumes in your RunPod account.
 *
 * Returns volume objects with details like name, size, and data center.
 */
class RunpodListNetworkVolumes implements Tool
{
    public function __construct(
        private RunpodService $service,
    ) {}

    public function name(): string
    {
        return 'runpod_list_network_volumes';
    }

    public function description(): string
    {
        return 'List all network volumes in your RunPod account. Returns volume IDs, names, sizes, and data center information.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('RunPod integration is not configured.');
            }

            $result = $this->service->listNetworkVolumes();

            $volumes = $result['networkVolumes'] ?? $result;

            $formatted = array_map(function (array $volume): array {
                return [
                    'volume_id' => $volume['id'] ?? null,
                    'name' => $volume['name'] ?? null,
                    'size_in_gb' => $volume['size'] ?? null,
                    'data_center_id' => $volume['dataCenterId'] ?? null,
                ];
            }, is_array($volumes) ? $volumes : []);

            return ToolResult::success([
                'network_volumes' => $formatted,
                'count' => count($formatted),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

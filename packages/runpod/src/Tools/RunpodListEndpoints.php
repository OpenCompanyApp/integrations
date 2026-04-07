<?php

namespace OpenCompany\Integrations\Runpod\Tools;

use OpenCompany\Integrations\Runpod\RunpodService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List all RunPod endpoints.
 *
 * Returns endpoint objects with details like name, status, and configuration.
 */
class RunpodListEndpoints implements Tool
{
    public function __construct(
        private RunpodService $service,
    ) {}

    public function name(): string
    {
        return 'runpod_list_endpoints';
    }

    public function description(): string
    {
        return 'List all RunPod endpoints. Returns endpoint IDs, names, statuses, and configuration details.';
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

            $result = $this->service->listEndpoints();

            $endpoints = $result['endpoints'] ?? $result;

            $formatted = array_map(function (array $endpoint): array {
                return [
                    'endpoint_id' => $endpoint['id'] ?? null,
                    'name' => $endpoint['name'] ?? null,
                    'status' => $endpoint['status'] ?? null,
                    'gpu_count' => $endpoint['gpuCount'] ?? null,
                    'image' => $endpoint['imageName'] ?? null,
                ];
            }, is_array($endpoints) ? $endpoints : []);

            return ToolResult::success([
                'endpoints' => $formatted,
                'count' => count($formatted),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

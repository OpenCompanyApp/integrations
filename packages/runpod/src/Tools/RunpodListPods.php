<?php

namespace OpenCompany\Integrations\Runpod\Tools;

use OpenCompany\Integrations\Runpod\RunpodService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List all GPU pods in your RunPod account.
 *
 * Returns an array of pod objects with details like name, status, GPU type, and runtime.
 */
class RunpodListPods implements Tool
{
    public function __construct(
        private RunpodService $service,
    ) {}

    public function name(): string
    {
        return 'runpod_list_pods';
    }

    public function description(): string
    {
        return 'List all GPU pods in your RunPod account. Returns pod IDs, names, status, GPU types, and runtime details.';
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

            $result = $this->service->listPods();

            $pods = $result['pods'] ?? $result;

            $formatted = array_map(function (array $pod): array {
                return [
                    'pod_id' => $pod['id'] ?? null,
                    'name' => $pod['name'] ?? null,
                    'status' => $pod['desiredStatus'] ?? ($pod['status'] ?? null),
                    'gpu_type' => $pod['machine']['gpuDisplayName'] ?? null,
                    'gpu_count' => $pod['machine']['gpuCount'] ?? null,
                    'image' => $pod['imageName'] ?? null,
                    'memory_in_gb' => $pod['memoryInGb'] ?? null,
                ];
            }, is_array($pods) ? $pods : []);

            return ToolResult::success([
                'pods' => $formatted,
                'count' => count($formatted),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

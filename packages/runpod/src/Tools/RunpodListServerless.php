<?php

namespace OpenCompany\Integrations\Runpod\Tools;

use OpenCompany\Integrations\Runpod\RunpodService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List all serverless endpoints in your RunPod account.
 *
 * Returns serverless endpoint objects with details like name, status, and worker configuration.
 */
class RunpodListServerless implements Tool
{
    public function __construct(
        private RunpodService $service,
    ) {}

    public function name(): string
    {
        return 'runpod_list_serverless';
    }

    public function description(): string
    {
        return 'List all serverless endpoints in your RunPod account. Returns endpoint IDs, names, statuses, and worker configurations.';
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

            $result = $this->service->listServerless();

            $serverless = $result['serverless'] ?? $result;

            $formatted = array_map(function (array $endpoint): array {
                return [
                    'endpoint_id' => $endpoint['id'] ?? null,
                    'name' => $endpoint['name'] ?? null,
                    'status' => $endpoint['status'] ?? null,
                    'gpu_count' => $endpoint['gpuCount'] ?? null,
                    'image' => $endpoint['imageName'] ?? null,
                    'workers_min' => $endpoint['workersMin'] ?? null,
                    'workers_max' => $endpoint['workersMax'] ?? null,
                ];
            }, is_array($serverless) ? $serverless : []);

            return ToolResult::success([
                'serverless' => $formatted,
                'count' => count($formatted),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

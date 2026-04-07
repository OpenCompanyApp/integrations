<?php

namespace OpenCompany\Integrations\Runpod\Tools;

use OpenCompany\Integrations\Runpod\RunpodService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get details of a specific RunPod GPU pod.
 *
 * Returns full pod details including name, status, GPU type, runtime, ports, and configuration.
 */
class RunpodGetPod implements Tool
{
    public function __construct(
        private RunpodService $service,
    ) {}

    public function name(): string
    {
        return 'runpod_get_pod';
    }

    public function description(): string
    {
        return 'Get detailed information about a specific RunPod GPU pod, including its status, GPU type, runtime, ports, and configuration. Use the pod ID obtained from runpod_list_pods.';
    }

    public function parameters(): array
    {
        return [
            'pod_id' => ['type' => 'string', 'required' => true, 'description' => 'The RunPod pod ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('RunPod integration is not configured.');
            }

            $podId = $args['pod_id'];
            $pod = $this->service->getPod($podId);

            return ToolResult::success($pod);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

<?php

namespace OpenCompany\Integrations\LambdaLabs\Tools;

use OpenCompany\Integrations\LambdaLabs\LambdaLabsService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class LambdaLabsLaunchInstance implements Tool
{
    public function __construct(
        private LambdaLabsService $service,
    ) {}

    public function name(): string
    {
        return 'lambda_labs_launch_instance';
    }

    public function description(): string
    {
        return 'Launch a new GPU instance on Lambda Labs. Requires a region name, instance type, SSH key IDs, and optionally a name and image.';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'A human-readable name for the instance (e.g., "gpu-training-01").'],
            'region_name' => ['type' => 'string', 'required' => true, 'description' => 'The region to launch in (e.g., "us-east-1", "us-west-2", "europe-central-1").'],
            'instance_type' => ['type' => 'string', 'required' => true, 'description' => 'The instance type slug (e.g., "gpu_1x_a100", "gpu_8x_h100").'],
            'ssh_key_ids' => ['type' => 'array', 'required' => true, 'description' => 'Array of SSH key IDs to assign to the instance.'],
            'image_id' => ['type' => 'string', 'description' => 'The image ID to use for the instance OS.'],
            'quantity' => ['type' => 'integer', 'description' => 'Number of instances to launch (default: 1).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Lambda Labs integration is not configured.');
            }

            $params = [
                'name' => $args['name'],
                'region_name' => $args['region_name'],
                'instance_type' => $args['instance_type'],
                'ssh_key_ids' => $args['ssh_key_ids'],
            ];

            // Optional parameters
            foreach (['image_id', 'quantity'] as $key) {
                if (isset($args[$key])) {
                    $params[$key] = $args[$key];
                }
            }

            $result = $this->service->launchInstance($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

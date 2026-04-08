<?php

namespace OpenCompany\Integrations\Speedcurve\Tools;

use OpenCompany\Integrations\Speedcurve\SpeedcurveService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class SpeedcurveCreateDeployment implements Tool
{
    public function __construct(
        private SpeedcurveService $service,
    ) {}

    public function name(): string
    {
        return 'speedcurve_create_deployment';
    }

    public function description(): string
    {
        return 'Register a new deployment in SpeedCurve to trigger synthetic performance tests. Use this when deploying code changes to track their performance impact.';
    }

    public function parameters(): array
    {
        return [
            'site_id' => ['type' => 'integer', 'required' => true, 'description' => 'The SpeedCurve site ID to deploy to.'],
            'note' => ['type' => 'string', 'description' => 'A description or note for this deployment (e.g., "Deploy v2.3.1 — new checkout flow").'],
            'detail' => ['type' => 'string', 'description' => 'Additional details about the deployment, such as a git commit SHA or changelog URL.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('SpeedCurve integration is not configured.');
            }

            if (!isset($args['site_id'])) {
                return ToolResult::error('site_id is required.');
            }

            $data = [
                'site_id' => (int) $args['site_id'],
            ];

            if (isset($args['note'])) {
                $data['note'] = $args['note'];
            }

            if (isset($args['detail'])) {
                $data['detail'] = $args['detail'];
            }

            $result = $this->service->createDeployment($data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

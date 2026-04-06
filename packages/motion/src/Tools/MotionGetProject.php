<?php

namespace OpenCompany\Integrations\Motion\Tools;

use OpenCompany\Integrations\Motion\MotionService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class MotionGetProject implements Tool
{
    public function __construct(
        private MotionService $service,
    ) {}

    public function name(): string
    {
        return 'motion_get_project';
    }

    public function description(): string
    {
        return 'Get details of a specific project in Motion by its ID. Returns the project name, description, status, and other metadata.';
    }

    public function parameters(): array
    {
        return [
            'projectId' => ['type' => 'string', 'required' => true, 'description' => 'The unique identifier of the project.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Motion integration is not configured.');
            }

            $result = $this->service->getProject($args['projectId']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

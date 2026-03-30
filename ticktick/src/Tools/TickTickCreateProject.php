<?php

namespace OpenCompany\Integrations\TickTick\Tools;

use OpenCompany\Integrations\TickTick\TickTickService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class TickTickCreateProject implements Tool
{
    public function __construct(
        private TickTickService $service,
    ) {}

    public function name(): string
    {
        return 'ticktick_create_project';
    }

    public function description(): string
    {
        return 'Create a new TickTick project (task list).';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'Name of the project.'],
            'color' => ['type' => 'string', 'description' => 'Color of the project (e.g., "#ff8c00").'],
            'view_mode' => ['type' => 'string', 'description' => 'View mode: "list", "kanban", or "timeline".'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('TickTick integration is not configured.');
            }

            $data = ['name' => $args['name']];

            if (isset($args['color'])) {
                $data['color'] = $args['color'];
            }
            if (isset($args['view_mode'])) {
                $data['viewMode'] = $args['view_mode'];
            }

            $result = $this->service->createProject($data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

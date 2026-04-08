<?php

namespace OpenCompany\Integrations\Nifty\Tools;

use OpenCompany\Integrations\Nifty\NiftyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class NiftyGetProject implements Tool
{
    public function __construct(
        private NiftyService $service,
    ) {}

    public function name(): string
    {
        return 'nifty_get_project';
    }

    public function description(): string
    {
        return 'Get details of a specific Nifty project by its ID, including name, description, status, and task lists.';
    }

    public function parameters(): array
    {
        return [
            'project_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the project to retrieve.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Nifty integration is not configured.');
            }

            if (empty($args['project_id'])) {
                return ToolResult::error('project_id is required.');
            }

            $result = $this->service->getProject($args['project_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

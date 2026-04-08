<?php

namespace OpenCompany\Integrations\Agora\Tools;

use OpenCompany\Integrations\Agora\AgoraService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class AgoraGetProject implements Tool
{
    public function __construct(
        private AgoraService $service,
    ) {}

    public function name(): string
    {
        return 'agora_get_project';
    }

    public function description(): string
    {
        return 'Get details of a specific Agora project by ID, including its name, App ID, App Certificate, and status.';
    }

    public function parameters(): array
    {
        return [
            'project_id' => ['type' => 'string', 'required' => true, 'description' => 'The project ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Agora integration is not configured.');
            }

            if (empty($args['project_id'])) {
                return ToolResult::error('The project ID is required.');
            }

            $result = $this->service->getProject($args['project_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

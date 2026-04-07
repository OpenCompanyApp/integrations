<?php

namespace OpenCompany\Integrations\Split\Tools;

use OpenCompany\Integrations\Split\SplitService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class SplitGetEnvironment implements Tool
{
    public function __construct(
        private SplitService $service,
    ) {}

    public function name(): string
    {
        return 'split_get_environment';
    }

    public function description(): string
    {
        return 'Get detailed information about a specific Split environment, including its name, type, and status.';
    }

    public function parameters(): array
    {
        return [
            'environment_id' => ['type' => 'string', 'required' => true, 'description' => 'The environment ID.'],
            'workspace_id' => ['type' => 'string', 'description' => 'The workspace ID (defaults to the configured workspace).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Split integration is not configured.');
            }

            if (empty($args['environment_id'])) {
                return ToolResult::error('The environment_id parameter is required.');
            }

            $workspaceId = $args['workspace_id'] ?? null;
            $result = $this->service->getEnvironment($args['environment_id'], $workspaceId);

            return ToolResult::success([
                'id' => $result['id'] ?? '',
                'name' => $result['name'] ?? '',
                'type' => $result['type'] ?? '',
                'status' => $result['status'] ?? '',
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

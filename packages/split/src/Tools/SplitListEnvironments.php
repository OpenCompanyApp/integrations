<?php

namespace OpenCompany\Integrations\Split\Tools;

use OpenCompany\Integrations\Split\SplitService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class SplitListEnvironments implements Tool
{
    public function __construct(
        private SplitService $service,
    ) {}

    public function name(): string
    {
        return 'split_list_environments';
    }

    public function description(): string
    {
        return 'List all environments for a Split workspace. Returns environment IDs, names, and their status.';
    }

    public function parameters(): array
    {
        return [
            'workspace_id' => ['type' => 'string', 'description' => 'The workspace ID (defaults to the configured workspace).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Split integration is not configured.');
            }

            $workspaceId = $args['workspace_id'] ?? null;
            $result = $this->service->listEnvironments($workspaceId);

            $environments = $result['objects'] ?? $result['data'] ?? [];

            $summary = array_map(function (array $env): array {
                return [
                    'id' => $env['id'] ?? '',
                    'name' => $env['name'] ?? '',
                    'type' => $env['type'] ?? '',
                    'status' => $env['status'] ?? '',
                ];
            }, $environments);

            return ToolResult::success([
                'environments' => $summary,
                'count' => count($summary),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

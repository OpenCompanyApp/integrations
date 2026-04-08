<?php

namespace OpenCompany\Integrations\Split\Tools;

use OpenCompany\Integrations\Split\SplitService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class SplitListWorkspaces implements Tool
{
    public function __construct(
        private SplitService $service,
    ) {}

    public function name(): string
    {
        return 'split_list_workspaces';
    }

    public function description(): string
    {
        return 'List all Split workspaces. Returns workspace IDs, names, and the number of environments.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Split integration is not configured.');
            }

            $result = $this->service->listWorkspaces();

            $workspaces = $result['objects'] ?? $result['data'] ?? [];

            $summary = array_map(function (array $workspace): array {
                return [
                    'id' => $workspace['id'] ?? '',
                    'name' => $workspace['name'] ?? '',
                    'type' => $workspace['type'] ?? '',
                ];
            }, $workspaces);

            return ToolResult::success([
                'workspaces' => $summary,
                'count' => count($summary),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

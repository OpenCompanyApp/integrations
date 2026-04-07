<?php

namespace OpenCompany\Integrations\Monday\Tools;

use OpenCompany\Integrations\Monday\MondayService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Monday.com workspaces the authenticated user has access to.
 */
class MondayListWorkspaces implements Tool
{
    /**
     * @param  MondayService  $service  The Monday.com API client
     */
    public function __construct(
        private MondayService $service,
    ) {}

    public function name(): string
    {
        return 'monday_list_workspaces';
    }

    public function description(): string
    {
        return <<<'MD'
        List Monday.com workspaces the authenticated user has access to.
        Returns workspace name, kind, description, and subscriber counts.
        Use workspace IDs to filter boards in monday_list_boards.
        MD;
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Max workspaces to return. Default: 50.'],
        ];
    }

    /**
     * List Monday.com workspaces.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Monday.com integration is not configured.');
            }

            $limit = (int) ($args['limit'] ?? 50);

            $result = $this->service->listWorkspaces($limit);
            $workspaces = $result['data']['workspaces'] ?? [];

            $nodes = array_map(function (array $ws) {
                return [
                    'id' => $ws['id'] ?? '',
                    'name' => $ws['name'] ?? '',
                    'description' => $ws['description'] ?? '',
                    'kind' => $ws['kind'] ?? '',
                    'owners_count' => $ws['owners_count'] ?? 0,
                    'subscribers_count' => $ws['subscribers_count'] ?? 0,
                    'is_deleted' => $ws['is_deleted'] ?? false,
                    'created_at' => $ws['created_at'] ?? '',
                ];
            }, $workspaces);

            return ToolResult::success([
                'workspaces' => $nodes,
                'total' => count($nodes),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

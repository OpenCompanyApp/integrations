<?php

namespace OpenCompany\Integrations\Monday\Tools;

use OpenCompany\Integrations\Monday\MondayService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Monday.com boards the authenticated user has access to.
 */
class MondayListBoards implements Tool
{
    /**
     * @param  MondayService  $service  The Monday.com API client
     */
    public function __construct(
        private MondayService $service,
    ) {}

    public function name(): string
    {
        return 'monday_list_boards';
    }

    public function description(): string
    {
        return <<<'MD'
        List Monday.com boards the authenticated user has access to.
        Optionally filter by workspace. Returns board name, kind, workspace,
        owner, and item count. Use monday_list_workspaces to discover workspace IDs.
        MD;
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Max boards to return. Default: 25.'],
            'workspace_id' => ['type' => 'integer', 'description' => 'Filter boards by workspace ID.'],
        ];
    }

    /**
     * List Monday.com boards.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Monday.com integration is not configured.');
            }

            $limit = (int) ($args['limit'] ?? 25);
            $workspaceId = isset($args['workspace_id']) ? (int) $args['workspace_id'] : null;

            $result = $this->service->listBoards($limit, $workspaceId);
            $boards = $result['data']['boards'] ?? [];

            $nodes = array_map(function (array $board) {
                return [
                    'id' => $board['id'] ?? '',
                    'name' => $board['name'] ?? '',
                    'description' => $board['description'] ?? '',
                    'board_kind' => $board['board_kind'] ?? '',
                    'workspace' => isset($board['workspace']) ? [
                        'id' => $board['workspace']['id'] ?? '',
                        'name' => $board['workspace']['name'] ?? '',
                    ] : null,
                    'owner' => isset($board['owner']) ? [
                        'id' => $board['owner']['id'] ?? '',
                        'name' => $board['owner']['name'] ?? '',
                    ] : null,
                    'items_count' => $board['items_count'] ?? 0,
                    'created_at' => $board['created_at'] ?? '',
                    'updated_at' => $board['updated_at'] ?? '',
                ];
            }, $boards);

            return ToolResult::success([
                'boards' => $nodes,
                'total' => count($nodes),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

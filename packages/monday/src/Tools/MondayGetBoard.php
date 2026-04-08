<?php

namespace OpenCompany\Integrations\Monday\Tools;

use OpenCompany\Integrations\Monday\MondayService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve a single Monday.com board by ID with columns and groups.
 */
class MondayGetBoard implements Tool
{
    /**
     * @param  MondayService  $service  The Monday.com API client
     */
    public function __construct(
        private MondayService $service,
    ) {}

    public function name(): string
    {
        return 'monday_get_board';
    }

    public function description(): string
    {
        return <<<'MD'
        Get a single Monday.com board by ID. Returns full board details
        including all columns (with types) and groups. Use monday_list_boards
        to discover board IDs.
        MD;
    }

    public function parameters(): array
    {
        return [
            'board_id' => ['type' => 'integer', 'required' => true, 'description' => 'Board ID to retrieve.'],
        ];
    }

    /**
     * Fetch a single Monday.com board by ID.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Monday.com integration is not configured.');
            }

            $boardId = $args['board_id'] ?? '';
            if (empty($boardId)) {
                return ToolResult::error('board_id is required.');
            }

            $result = $this->service->getBoard((int) $boardId);
            $boards = $result['data']['boards'] ?? [];
            $board = $boards[0] ?? null;

            if ($board === null) {
                return ToolResult::error("Board not found: {$boardId}");
            }

            return ToolResult::success([
                'id' => $board['id'] ?? '',
                'name' => $board['name'] ?? '',
                'description' => $board['description'] ?? '',
                'board_kind' => $board['board_kind'] ?? '',
                'state' => $board['state'] ?? '',
                'workspace' => isset($board['workspace']) ? [
                    'id' => $board['workspace']['id'] ?? '',
                    'name' => $board['workspace']['name'] ?? '',
                ] : null,
                'owner' => isset($board['owner']) ? [
                    'id' => $board['owner']['id'] ?? '',
                    'name' => $board['owner']['name'] ?? '',
                ] : null,
                'items_count' => $board['items_count'] ?? 0,
                'columns' => array_map(fn (array $col) => [
                    'id' => $col['id'] ?? '',
                    'title' => $col['title'] ?? '',
                    'type' => $col['type'] ?? '',
                    'archived' => $col['archived'] ?? false,
                ], $board['columns'] ?? []),
                'groups' => array_map(fn (array $grp) => [
                    'id' => $grp['id'] ?? '',
                    'title' => $grp['title'] ?? '',
                    'color' => $grp['color'] ?? '',
                    'position' => $grp['position'] ?? 0,
                    'deleted' => $grp['deleted'] ?? false,
                ], $board['groups'] ?? []),
                'created_at' => $board['created_at'] ?? '',
                'updated_at' => $board['updated_at'] ?? '',
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

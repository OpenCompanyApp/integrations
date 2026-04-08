<?php

namespace OpenCompany\Integrations\Monday\Tools;

use OpenCompany\Integrations\Monday\MondayService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List items on a Monday.com board with pagination.
 */
class MondayListItems implements Tool
{
    /**
     * @param  MondayService  $service  The Monday.com API client
     */
    public function __construct(
        private MondayService $service,
    ) {}

    public function name(): string
    {
        return 'monday_list_items';
    }

    public function description(): string
    {
        return <<<'MD'
        List items on a Monday.com board with pagination. Returns item name,
        state, group, creator, and timestamps. Use monday_list_boards or
        monday_get_board to discover board IDs.
        MD;
    }

    public function parameters(): array
    {
        return [
            'board_id' => ['type' => 'integer', 'required' => true, 'description' => 'Board ID to list items for.'],
            'limit' => ['type' => 'integer', 'description' => 'Results per page. Default: 25.'],
            'page' => ['type' => 'integer', 'description' => 'Page number (1-based). Default: 1.'],
        ];
    }

    /**
     * List items on a Monday.com board.
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

            $limit = (int) ($args['limit'] ?? 25);
            $page = (int) ($args['page'] ?? 1);

            $result = $this->service->listItems((int) $boardId, $limit, $page);
            $boards = $result['data']['boards'] ?? [];
            $items = $boards[0]['items'] ?? [];

            $nodes = array_map(function (array $item) {
                return [
                    'id' => $item['id'] ?? '',
                    'name' => $item['name'] ?? '',
                    'state' => $item['state'] ?? '',
                    'group' => isset($item['group']) ? [
                        'id' => $item['group']['id'] ?? '',
                        'title' => $item['group']['title'] ?? '',
                    ] : null,
                    'creator' => isset($item['creator']) ? [
                        'id' => $item['creator']['id'] ?? '',
                        'name' => $item['creator']['name'] ?? '',
                    ] : null,
                    'created_at' => $item['created_at'] ?? '',
                    'updated_at' => $item['updated_at'] ?? '',
                ];
            }, $items);

            return ToolResult::success([
                'items' => $nodes,
                'total' => count($nodes),
                'page' => $page,
                'limit' => $limit,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

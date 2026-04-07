<?php

namespace OpenCompany\Integrations\Trello\Tools;

use OpenCompany\Integrations\Trello\TrelloService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List all boards for the authenticated member.
 *
 * Returns a list of boards with optional filtering and field selection.
 */
class TrelloListBoards implements Tool
{
    public function __construct(
        private TrelloService $service,
    ) {}

    public function name(): string
    {
        return 'trello_list_boards';
    }

    public function description(): string
    {
        return 'List all boards for the authenticated Trello member. Supports filtering by status and field selection.';
    }

    public function parameters(): array
    {
        return [
            'filter' => ['type' => 'string', 'description' => 'Filter: "all", "closed", "members", "open", "organization", "public" (default: "all").'],
            'fields' => ['type' => 'string', 'description' => 'Comma-separated board fields to return (default: "all").'],
            'limit' => ['type' => 'integer', 'description' => 'Max number of boards to return (1–1000).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Trello integration is not configured.');
            }

            $params = [];

            if (isset($args['filter'])) {
                $params['filter'] = $args['filter'];
            }
            if (isset($args['fields'])) {
                $params['fields'] = $args['fields'];
            }
            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }

            $boards = $this->service->listBoards($params);

            return ToolResult::success($boards);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

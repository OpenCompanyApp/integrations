<?php

namespace OpenCompany\Integrations\Monday\Tools;

use OpenCompany\Integrations\Monday\MondayService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List boards on Monday.com.
 *
 * Retrieves boards accessible to the authenticated user, with optional
 * pagination and workspace filtering.
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
        return 'List boards on Monday.com with optional filters.';
    }

    public function parameters(): array
    {
        return [
            'limit'        => ['type' => 'integer', 'description' => 'Maximum number of boards to return (default 25).'],
            'page'         => ['type' => 'integer', 'description' => 'Page number for pagination (starts at 1).'],
            'workspace_id' => ['type' => 'integer', 'description' => 'The ID of the workspace to filter boards by.'],
        ];
    }

    /**
     * Retrieve a list of boards with optional filters.
     *
     * @param  array<string, mixed>  $args  Tool arguments (limit, page, workspace_id)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Monday.com integration is not configured.');
            }

            $limit = $args['limit'] ?? 25;
            $page = $args['page'] ?? 1;

            $params = "limit: {$limit}, page: {$page}";

            if (isset($args['workspace_id']) && ! empty($args['workspace_id'])) {
                $params .= ", workspace_ids: [{$args['workspace_id']}]";
            }

            $query = <<<GRAPHQL
            query {
                boards ({$params}) {
                    id
                    name
                    state
                    board_kind
                    workspace { id name }
                }
            }
            GRAPHQL;

            $result = $this->service->graphql($query);

            return ToolResult::success($result['boards'] ?? []);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

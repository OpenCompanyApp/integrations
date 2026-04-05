<?php

namespace OpenCompany\Integrations\Monday\Tools;

use OpenCompany\Integrations\Monday\MondayService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List workspaces on Monday.com.
 *
 * Retrieves all workspaces accessible to the authenticated user.
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
        return 'List workspaces on Monday.com.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of workspaces to return (default 25).'],
        ];
    }

    /**
     * Retrieve a list of workspaces.
     *
     * @param  array<string, mixed>  $args  Tool arguments (limit)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Monday.com integration is not configured.');
            }

            $limit = $args['limit'] ?? 25;

            $query = <<<GRAPHQL
            query {
                workspaces (limit: {$limit}) {
                    id
                    name
                    state
                    kind
                }
            }
            GRAPHQL;

            $result = $this->service->graphql($query);

            return ToolResult::success($result['workspaces'] ?? []);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

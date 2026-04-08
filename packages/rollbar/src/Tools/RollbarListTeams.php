<?php

namespace OpenCompany\Integrations\Rollbar\Tools;

use OpenCompany\Integrations\Rollbar\RollbarService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to list all teams in the Rollbar account.
 *
 * Returns a paginated list of teams including their IDs, names,
 * and member counts.
 *
 * @see https://docs.rollbar.com/docs/list-all-teams
 */
class RollbarListTeams implements Tool
{
    /**
     * Create a new RollbarListTeams tool instance.
     */
    public function __construct(
        private RollbarService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'rollbar_list_teams';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'List all teams in your Rollbar account.';
    }

    /**
     * Get the tool parameter definitions.
     */
    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of teams to return (default: 20).'],
            'offset' => ['type' => 'integer', 'description' => 'Offset for pagination (default: 0).'],
        ];
    }

    /**
     * Execute the tool and return the result.
     *
     * @param  array  $args  Tool arguments (limit, offset)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Rollbar integration is not configured.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 20;
            $offset = isset($args['offset']) ? (int) $args['offset'] : 0;

            $result = $this->service->listTeams($limit, $offset);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

<?php

namespace OpenCompany\Integrations\Jira\Tools;

use OpenCompany\Integrations\Jira\JiraService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List sprints for a Jira board.
 */
class JiraListSprints implements Tool
{
    /** @param  JiraService  $service  The Jira API client */
    public function __construct(
        private JiraService $service,
    ) {}

    public function name(): string
    {
        return 'jira_list_sprints';
    }

    public function description(): string
    {
        return 'List sprints for a specific Jira board. Optionally filter by sprint state (active, closed, future).';
    }

    public function parameters(): array
    {
        return [
            'board_id' => ['type' => 'integer', 'required' => true, 'description' => 'The board ID. Use jira_list_boards to find board IDs.'],
            'state' => ['type' => 'string', 'description' => 'Filter by sprint state: active, closed, or future.'],
        ];
    }

    /**
     * Retrieve sprints for the specified Jira board.
     *
     * @param  array<string, mixed>  $args  Tool arguments (board_id, state)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('Jira is not configured. Missing API token.');
        }

        $boardId = $args['board_id'] ?? '';

        if (empty($boardId)) {
            return ToolResult::error('Board ID is required.');
        }

        try {
            $params = [];

            if (isset($args['state'])) {
                $params['state'] = $args['state'];
            }

            $result = $this->service->listSprints((int) $boardId, $params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

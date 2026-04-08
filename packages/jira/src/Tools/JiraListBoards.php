<?php

namespace OpenCompany\Integrations\Jira\Tools;

use OpenCompany\Integrations\Jira\JiraService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Jira agile boards.
 */
class JiraListBoards implements Tool
{
    /** @param  JiraService  $service  The Jira API client */
    public function __construct(
        private JiraService $service,
    ) {}

    public function name(): string
    {
        return 'jira_list_boards';
    }

    public function description(): string
    {
        return 'List agile boards accessible to the authenticated user. Supports pagination with start_at and max_results.';
    }

    public function parameters(): array
    {
        return [
            'start_at' => ['type' => 'integer', 'description' => 'Offset for pagination (0-based). Default: 0.'],
            'max_results' => ['type' => 'integer', 'description' => 'Maximum number of results per page (1-100). Default: 50.'],
        ];
    }

    /**
     * Retrieve a paginated list of Jira agile boards.
     *
     * @param  array<string, mixed>  $args  Tool arguments (start_at, max_results)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('Jira is not configured. Missing API token.');
        }

        try {
            $params = [];

            if (isset($args['start_at'])) {
                $params['startAt'] = (int) $args['start_at'];
            }

            if (isset($args['max_results'])) {
                $params['maxResults'] = (int) $args['max_results'];
            }

            $result = $this->service->listBoards($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

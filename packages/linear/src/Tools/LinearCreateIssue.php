<?php

namespace OpenCompany\Integrations\Linear\Tools;

use OpenCompany\Integrations\Linear\LinearService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new issue in Linear under a specified team.
 */
class LinearCreateIssue implements Tool
{
    /**
     * @param  LinearService  $service  The Linear API client
     */
    public function __construct(
        private LinearService $service,
    ) {}

    public function name(): string
    {
        return 'linear_create_issue';
    }

    public function description(): string
    {
        return <<<'MD'
        Create a new issue in Linear. Requires a team ID and title.
        Optionally set description, priority (0=none, 1=urgent, 2=high, 3=medium, 4=low),
        assignee, labels, and initial state.
        Use linear_get_teams to find team IDs.
        MD;
    }

    public function parameters(): array
    {
        return [
            'team_id' => ['type' => 'string', 'required' => true, 'description' => 'Team ID to create the issue in.'],
            'title' => ['type' => 'string', 'required' => true, 'description' => 'Issue title.'],
            'description' => ['type' => 'string', 'description' => 'Issue description (markdown supported).'],
            'priority' => ['type' => 'integer', 'description' => 'Priority: 0=none, 1=urgent, 2=high, 3=medium, 4=low.'],
            'assignee_id' => ['type' => 'string', 'description' => 'User ID to assign the issue to.'],
            'label_ids' => ['type' => 'string', 'description' => 'Comma-separated label IDs to apply.'],
            'state_id' => ['type' => 'string', 'description' => 'Workflow state ID for the initial status.'],
        ];
    }

    /**
     * Create a new Linear issue with the given parameters.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Linear integration is not configured.');
            }

            $teamId = $args['team_id'] ?? '';
            $title = $args['title'] ?? '';

            if (empty($teamId)) {
                return ToolResult::error('team_id is required.');
            }
            if (empty($title)) {
                return ToolResult::error('title is required.');
            }

            $input = [
                'teamId' => $teamId,
                'title' => $title,
            ];

            if (isset($args['description'])) {
                $input['description'] = $args['description'];
            }
            if (isset($args['priority'])) {
                $input['priority'] = (int) $args['priority'];
            }
            if (! empty($args['assignee_id'])) {
                $input['assigneeId'] = $args['assignee_id'];
            }
            if (! empty($args['label_ids'])) {
                $input['labelIds'] = array_map('trim', explode(',', $args['label_ids']));
            }
            if (! empty($args['state_id'])) {
                $input['stateId'] = $args['state_id'];
            }

            $result = $this->service->createIssue($input);
            $issue = $result['data']['issueCreate']['issue'] ?? null;

            if ($issue === null) {
                return ToolResult::error('Failed to create issue. The API returned no issue data.');
            }

            return ToolResult::success([
                'id' => $issue['id'] ?? '',
                'identifier' => $issue['identifier'] ?? '',
                'title' => $issue['title'] ?? '',
                'url' => $issue['url'] ?? '',
                'state' => $issue['state']['name'] ?? '',
                'assignee' => $issue['assignee']['name'] ?? null,
                'priority' => $issue['priority'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

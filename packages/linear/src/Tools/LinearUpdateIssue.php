<?php

namespace OpenCompany\Integrations\Linear\Tools;

use OpenCompany\Integrations\Linear\LinearService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update an existing Linear issue's fields such as title, description, priority, assignee, and state.
 */
class LinearUpdateIssue implements Tool
{
    /**
     * @param  LinearService  $service  The Linear API client
     */
    public function __construct(
        private LinearService $service,
    ) {}

    public function name(): string
    {
        return 'linear_update_issue';
    }

    public function description(): string
    {
        return <<<'MD'
        Update an existing Linear issue. Provide the issue ID or identifier
        and any fields to change. Only specified fields will be updated.
        Priority: 0=none, 1=urgent, 2=high, 3=medium, 4=low.
        MD;
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Issue ID or identifier to update.'],
            'title' => ['type' => 'string', 'description' => 'New title.'],
            'description' => ['type' => 'string', 'description' => 'New description (markdown).'],
            'priority' => ['type' => 'integer', 'description' => 'Priority: 0=none, 1=urgent, 2=high, 3=medium, 4=low.'],
            'assignee_id' => ['type' => 'string', 'description' => 'User ID to assign.'],
            'state_id' => ['type' => 'string', 'description' => 'Workflow state ID to set.'],
            'label_ids' => ['type' => 'string', 'description' => 'Comma-separated label IDs to set (replaces existing labels).'],
        ];
    }

    /**
     * Update a Linear issue with the given field changes.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Linear integration is not configured.');
            }

            $id = $args['id'] ?? '';
            if (empty($id)) {
                return ToolResult::error('id is required.');
            }

            $input = [];

            if (isset($args['title'])) {
                $input['title'] = $args['title'];
            }
            if (isset($args['description'])) {
                $input['description'] = $args['description'];
            }
            if (isset($args['priority'])) {
                $input['priority'] = (int) $args['priority'];
            }
            if (array_key_exists('assignee_id', $args)) {
                $input['assigneeId'] = $args['assignee_id'];
            }
            if (! empty($args['state_id'])) {
                $input['stateId'] = $args['state_id'];
            }
            if (array_key_exists('label_ids', $args)) {
                $input['labelIds'] = array_map('trim', explode(',', $args['label_ids']));
            }

            if (empty($input)) {
                return ToolResult::error('No fields provided to update.');
            }

            $result = $this->service->updateIssue($id, $input);
            $issue = $result['data']['issueUpdate']['issue'] ?? null;

            if ($issue === null) {
                return ToolResult::error('Failed to update issue. The API returned no issue data.');
            }

            return ToolResult::success([
                'id' => $issue['id'] ?? '',
                'identifier' => $issue['identifier'] ?? '',
                'title' => $issue['title'] ?? '',
                'url' => $issue['url'] ?? '',
                'state' => $issue['state']['name'] ?? '',
                'assignee' => $issue['assignee']['name'] ?? null,
                'priority' => $issue['priority'] ?? null,
                'labels' => array_map(fn (array $l) => $l['name'] ?? '', $issue['labels']['nodes'] ?? []),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

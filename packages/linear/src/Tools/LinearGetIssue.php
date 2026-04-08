<?php

namespace OpenCompany\Integrations\Linear\Tools;

use OpenCompany\Integrations\Linear\LinearService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve a single Linear issue by ID or identifier with full details.
 */
class LinearGetIssue implements Tool
{
    /**
     * @param  LinearService  $service  The Linear API client
     */
    public function __construct(
        private LinearService $service,
    ) {}

    public function name(): string
    {
        return 'linear_get_issue';
    }

    public function description(): string
    {
        return <<<'MD'
        Get a single Linear issue by ID or identifier (e.g., "TEAM-123").
        Returns full details including description, state, assignee, labels,
        team info, and comments.
        MD;
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Issue ID or identifier (e.g., "TEAM-123").'],
        ];
    }

    /**
     * Fetch a single Linear issue by ID or identifier.
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

            $result = $this->service->getIssue($id);
            $issue = $result['data']['issue'] ?? null;

            if ($issue === null) {
                return ToolResult::error("Issue not found: {$id}");
            }

            return ToolResult::success([
                'id' => $issue['id'] ?? '',
                'identifier' => $issue['identifier'] ?? '',
                'title' => $issue['title'] ?? '',
                'description' => $issue['description'] ?? '',
                'url' => $issue['url'] ?? '',
                'state' => $issue['state']['name'] ?? '',
                'state_type' => $issue['state']['type'] ?? '',
                'assignee' => isset($issue['assignee']) ? [
                    'id' => $issue['assignee']['id'] ?? '',
                    'name' => $issue['assignee']['name'] ?? '',
                    'email' => $issue['assignee']['email'] ?? '',
                ] : null,
                'priority' => $issue['priority'] ?? null,
                'labels' => array_map(fn (array $l) => [
                    'id' => $l['id'] ?? '',
                    'name' => $l['name'] ?? '',
                    'color' => $l['color'] ?? '',
                ], $issue['labels']['nodes'] ?? []),
                'team' => isset($issue['team']) ? [
                    'id' => $issue['team']['id'] ?? '',
                    'name' => $issue['team']['name'] ?? '',
                    'key' => $issue['team']['key'] ?? '',
                ] : null,
                'comments' => array_map(fn (array $c) => [
                    'id' => $c['id'] ?? '',
                    'body' => $c['body'] ?? '',
                    'user' => $c['user']['name'] ?? '',
                    'created_at' => $c['createdAt'] ?? '',
                ], $issue['comments']['nodes'] ?? []),
                'created_at' => $issue['createdAt'] ?? '',
                'updated_at' => $issue['updatedAt'] ?? '',
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

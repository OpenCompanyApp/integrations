<?php

namespace OpenCompany\Integrations\Linear\Tools;

use OpenCompany\Integrations\Linear\LinearService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new Linear project associated with one or more teams.
 */
class LinearCreateProject implements Tool
{
    /**
     * @param  LinearService  $service  The Linear API client
     */
    public function __construct(
        private LinearService $service,
    ) {}

    public function name(): string
    {
        return 'linear_create_project';
    }

    public function description(): string
    {
        return <<<'MD'
        Create a new Linear project. Requires a name and at least one team ID.
        Optionally set description, lead, and target dates.
        Use linear_get_teams to find team IDs.
        MD;
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'Project name.'],
            'description' => ['type' => 'string', 'description' => 'Project description.'],
            'team_ids' => ['type' => 'string', 'required' => true, 'description' => 'Comma-separated team IDs to associate.'],
            'lead_id' => ['type' => 'string', 'description' => 'User ID of the project lead.'],
        ];
    }

    /**
     * Create a new Linear project.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Linear integration is not configured.');
            }

            $name = $args['name'] ?? '';
            $teamIds = $args['team_ids'] ?? '';

            if (empty($name)) {
                return ToolResult::error('name is required.');
            }
            if (empty($teamIds)) {
                return ToolResult::error('team_ids is required.');
            }

            $input = [
                'name' => $name,
                'teamIds' => array_map('trim', explode(',', $teamIds)),
            ];

            if (isset($args['description'])) {
                $input['description'] = $args['description'];
            }
            if (! empty($args['lead_id'])) {
                $input['leadId'] = $args['lead_id'];
            }

            $result = $this->service->createProject($input);
            $project = $result['data']['projectCreate']['project'] ?? null;

            if ($project === null) {
                return ToolResult::error('Failed to create project.');
            }

            return ToolResult::success([
                'id' => $project['id'] ?? '',
                'name' => $project['name'] ?? '',
                'description' => $project['description'] ?? '',
                'state' => $project['state'] ?? '',
                'url' => $project['url'] ?? '',
                'teams' => array_map(fn (array $t) => $t['name'] ?? '', $project['teams']['nodes'] ?? []),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

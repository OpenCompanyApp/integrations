<?php

namespace OpenCompany\Integrations\Mattermost\Tools;

use OpenCompany\Integrations\Mattermost\MattermostService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get a Mattermost team by ID.
 */
class MattermostGetTeam implements Tool
{
    /**
     * @param  MattermostService  $service  The Mattermost API client
     */
    public function __construct(
        private MattermostService $service,
    ) {}

    public function name(): string
    {
        return 'mattermost_get_team';
    }

    public function description(): string
    {
        return 'Get a Mattermost team by its ID.';
    }

    public function parameters(): array
    {
        return [
            'team_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the team to retrieve.'],
        ];
    }

    /**
     * Get a Mattermost team by ID.
     *
     * @param  array<string, mixed>  $args  Tool arguments (team_id)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Mattermost integration is not configured.');
            }

            $teamId = $args['team_id'] ?? '';

            if (empty($teamId)) {
                return ToolResult::error('team_id is required.');
            }

            $result = $this->service->getTeam($teamId);

            return ToolResult::success([
                'ok' => true,
                'team' => $result,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

<?php

namespace OpenCompany\Integrations\Teams\Tools;

use OpenCompany\Integrations\Teams\TeamsService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List all channels in a Microsoft Team.
 *
 * Supports pagination via top and skip parameters.
 */
class TeamsListChannels implements Tool
{
    /**
     * @param  TeamsService  $service  The Microsoft Graph API client
     */
    public function __construct(
        private TeamsService $service,
    ) {}

    public function name(): string
    {
        return 'teams_list_channels';
    }

    public function description(): string
    {
        return 'List all channels in a Microsoft Team.';
    }

    public function parameters(): array
    {
        return [
            'team_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the team.'],
            'top' => ['type' => 'integer', 'description' => 'Number of channels to return (default 20, max 999).'],
            'skip' => ['type' => 'integer', 'description' => 'Number of channels to skip for pagination.'],
        ];
    }

    /**
     * List channels in a team with optional pagination.
     *
     * @param  array<string, mixed>  $args  Tool arguments (team_id, top, skip)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Microsoft Teams integration is not configured.');
            }

            $teamId = $args['team_id'] ?? '';

            if (empty($teamId)) {
                return ToolResult::error('team_id is required.');
            }

            $params = [];

            if (isset($args['top'])) {
                $params['$top'] = (int) $args['top'];
            }
            if (isset($args['skip'])) {
                $params['$skip'] = (int) $args['skip'];
            }

            $result = $this->service->listChannels($teamId, $params);

            return ToolResult::success([
                'ok' => true,
                'channels' => $result['value'] ?? [],
                '@odata.nextLink' => $result['@odata.nextLink'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

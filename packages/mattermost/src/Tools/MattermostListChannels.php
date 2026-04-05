<?php

namespace OpenCompany\Integrations\Mattermost\Tools;

use OpenCompany\Integrations\Mattermost\MattermostService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List channels in a Mattermost team.
 *
 * Supports pagination via page and per_page parameters.
 */
class MattermostListChannels implements Tool
{
    /**
     * @param  MattermostService  $service  The Mattermost API client
     */
    public function __construct(
        private MattermostService $service,
    ) {}

    public function name(): string
    {
        return 'mattermost_list_channels';
    }

    public function description(): string
    {
        return 'List channels in a Mattermost team. Supports pagination with page and per_page.';
    }

    public function parameters(): array
    {
        return [
            'team_id'  => ['type' => 'string', 'required' => true, 'description' => 'The ID of the team to list channels for.'],
            'page'     => ['type' => 'integer', 'description' => 'The page number to retrieve (0-indexed, default 0).'],
            'per_page' => ['type' => 'integer', 'description' => 'Number of channels per page (default 60).'],
        ];
    }

    /**
     * List channels in a Mattermost team.
     *
     * @param  array<string, mixed>  $args  Tool arguments (team_id, page, per_page)
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

            $params = [];

            if (isset($args['page'])) {
                $params['page'] = (int) $args['page'];
            }
            if (isset($args['per_page'])) {
                $params['per_page'] = (int) $args['per_page'];
            }

            $result = $this->service->listChannels($teamId, $params);

            return ToolResult::success([
                'ok' => true,
                'channels' => $result,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

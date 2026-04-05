<?php

namespace OpenCompany\Integrations\Mattermost\Tools;

use OpenCompany\Integrations\Mattermost\MattermostService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List all Mattermost teams.
 *
 * Supports pagination via page and per_page parameters.
 */
class MattermostListTeams implements Tool
{
    /**
     * @param  MattermostService  $service  The Mattermost API client
     */
    public function __construct(
        private MattermostService $service,
    ) {}

    public function name(): string
    {
        return 'mattermost_list_teams';
    }

    public function description(): string
    {
        return 'List all Mattermost teams. Supports pagination with page and per_page.';
    }

    public function parameters(): array
    {
        return [
            'page'     => ['type' => 'integer', 'description' => 'The page number to retrieve (0-indexed, default 0).'],
            'per_page' => ['type' => 'integer', 'description' => 'Number of teams per page (default 60).'],
        ];
    }

    /**
     * List all Mattermost teams.
     *
     * @param  array<string, mixed>  $args  Tool arguments (page, per_page)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Mattermost integration is not configured.');
            }

            $params = [];

            if (isset($args['page'])) {
                $params['page'] = (int) $args['page'];
            }
            if (isset($args['per_page'])) {
                $params['per_page'] = (int) $args['per_page'];
            }

            $result = $this->service->listTeams($params);

            return ToolResult::success([
                'ok' => true,
                'teams' => $result,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

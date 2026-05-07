<?php

namespace OpenCompany\Integrations\Mattermost\Tools;

use OpenCompany\Integrations\Mattermost\MattermostService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List teams the current user belongs to.
 *
 * Returns an array of team objects including id, name, display_name,
 * description, type (O = open, I = invite), and email.
 */
class MattermostListTeams implements Tool
{
    /**
     * @param  MattermostService  $service  Mattermost API client.
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
        return 'List teams the current user belongs to in Mattermost. Returns team IDs, names, display names, and types. Use this to discover available teams before working with channels.';
    }

    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number (0-indexed). Default: 0.'],
            'per_page' => ['type' => 'integer', 'description' => 'Number of teams per page. Default: 60.'],
        ];
    }

    /**
     * List Mattermost teams visible to the current user.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Mattermost integration is not configured.');
            }

            $page = isset($args['page']) ? (int) $args['page'] : 0;
            $perPage = isset($args['per_page']) ? (int) $args['per_page'] : 60;

            $result = $this->service->listTeams($page, $perPage);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

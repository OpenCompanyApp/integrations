<?php

namespace OpenCompany\Integrations\Mattermost\Tools;

use OpenCompany\Integrations\Mattermost\MattermostService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Mattermost users.
 *
 * Supports pagination and filtering by team via page, per_page, and in_team_id parameters.
 */
class MattermostListUsers implements Tool
{
    /**
     * @param  MattermostService  $service  The Mattermost API client
     */
    public function __construct(
        private MattermostService $service,
    ) {}

    public function name(): string
    {
        return 'mattermost_list_users';
    }

    public function description(): string
    {
        return 'List Mattermost users. Supports pagination with page and per_page, and filtering by team with in_team_id.';
    }

    public function parameters(): array
    {
        return [
            'page'       => ['type' => 'integer', 'description' => 'The page number to retrieve (0-indexed, default 0).'],
            'per_page'   => ['type' => 'integer', 'description' => 'Number of users per page (default 60).'],
            'in_team_id' => ['type' => 'string', 'description' => 'Filter users to those in the specified team.'],
        ];
    }

    /**
     * List Mattermost users.
     *
     * @param  array<string, mixed>  $args  Tool arguments (page, per_page, in_team_id)
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
            if (! empty($args['in_team_id'])) {
                $params['in_team_id'] = $args['in_team_id'];
            }

            $result = $this->service->listUsers($params);

            return ToolResult::success([
                'ok' => true,
                'users' => $result,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

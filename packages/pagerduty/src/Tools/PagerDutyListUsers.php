<?php

namespace OpenCompany\Integrations\PagerDuty\Tools;

use OpenCompany\Integrations\PagerDuty\PagerDutyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List PagerDuty users with optional filtering and pagination.
 *
 * Supports filtering by team IDs. Returns user details including
 * name, email, role, and team memberships.
 */
class PagerDutyListUsers implements Tool
{
    /**
     * @param  PagerDutyService  $service  The PagerDuty API client
     */
    public function __construct(
        private PagerDutyService $service,
    ) {}

    public function name(): string
    {
        return 'pagerduty_list_users';
    }

    public function description(): string
    {
        return <<<'MD'
        List PagerDuty users with optional filtering by team.
        Supports pagination with limit and offset.
        Returns user details including name, email, role, and teams.
        MD;
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Number of users to return (1–100, default 25).'],
            'offset' => ['type' => 'integer', 'description' => 'Offset for pagination (default 0).'],
            'team_ids' => ['type' => 'array', 'description' => 'Filter by team IDs (array of team ID strings).'],
        ];
    }

    /**
     * List PagerDuty users with optional filtering and pagination.
     *
     * @param  array<string, mixed>  $args  Tool arguments (limit, offset, team_ids)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('PagerDuty integration is not configured.');
            }

            $params = [];

            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }
            if (isset($args['offset'])) {
                $params['offset'] = (int) $args['offset'];
            }
            if (isset($args['team_ids']) && is_array($args['team_ids'])) {
                foreach ($args['team_ids'] as $i => $teamId) {
                    $params["team_ids[]"][$i] = $teamId;
                }
            }

            $result = $this->service->listUsers($params);

            $users = array_map(function (array $user) {
                return [
                    'id' => $user['id'] ?? '',
                    'name' => $user['name'] ?? '',
                    'email' => $user['email'] ?? '',
                    'role' => $user['role'] ?? '',
                    'title' => $user['job_title'] ?? null,
                    'teams' => array_map(function (array $t) {
                        return [
                            'id' => $t['id'] ?? '',
                            'name' => $t['summary'] ?? '',
                        ];
                    }, $user['teams'] ?? []),
                    'avatar_url' => $user['avatar_url'] ?? null,
                    'html_url' => $user['html_url'] ?? '',
                ];
            }, $result['users'] ?? []);

            return ToolResult::success([
                'users' => $users,
                'total' => $result['total'] ?? count($users),
                'more' => $result['more'] ?? false,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

<?php

namespace OpenCompany\Integrations\Slack\Tools;

use OpenCompany\Integrations\Slack\SlackService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List all users in the Slack workspace.
 *
 * Supports pagination via cursors.
 */
class SlackListUsers implements Tool
{
    /**
     * @param  SlackService  $service  The Slack API client
     */
    public function __construct(
        private SlackService $service,
    ) {}

    public function name(): string
    {
        return 'slack_list_users';
    }

    public function description(): string
    {
        return 'List all users in the Slack workspace.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Number of users per page (default 100, max 1000).'],
            'cursor' => ['type' => 'string', 'description' => 'Pagination cursor from a previous response.'],
            'include_locale' => ['type' => 'boolean', 'description' => 'Include user locale information (default: false).'],
        ];
    }

    /**
     * List users with optional pagination.
     *
     * @param  array<string, mixed>  $args  Tool arguments (limit, cursor, include_locale)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Slack integration is not configured.');
            }

            $params = [];

            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }
            if (isset($args['cursor'])) {
                $params['cursor'] = $args['cursor'];
            }
            if (isset($args['include_locale'])) {
                $params['include_locale'] = (bool) $args['include_locale'];
            }

            $result = $this->service->listUsers($params);

            return ToolResult::success([
                'ok' => true,
                'members' => $result['members'] ?? [],
                'response_metadata' => $result['response_metadata'] ?? [],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

<?php

namespace OpenCompany\Integrations\Slack\Tools;

use OpenCompany\Integrations\Slack\SlackService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List all usergroups in the Slack workspace.
 */
class SlackListUsergroups implements Tool
{
    /**
     * @param  SlackService  $service  The Slack API client
     */
    public function __construct(
        private SlackService $service,
    ) {}

    public function name(): string
    {
        return 'slack_list_usergroups';
    }

    public function description(): string
    {
        return 'List all usergroups in the Slack workspace.';
    }

    public function parameters(): array
    {
        return [
            'include_count' => ['type' => 'boolean', 'description' => 'Include the number of users in each usergroup (default: false).'],
            'include_disabled' => ['type' => 'boolean', 'description' => 'Include disabled usergroups (default: false).'],
            'include_users' => ['type' => 'boolean', 'description' => 'Include the list of users in each usergroup (default: false).'],
        ];
    }

    /**
     * List usergroups with optional inclusion flags.
     *
     * @param  array<string, mixed>  $args  Tool arguments (include_count, include_disabled, include_users)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Slack integration is not configured.');
            }

            $params = [];

            if (isset($args['include_count'])) {
                $params['include_count'] = (bool) $args['include_count'];
            }
            if (isset($args['include_disabled'])) {
                $params['include_disabled'] = (bool) $args['include_disabled'];
            }
            if (isset($args['include_users'])) {
                $params['include_users'] = (bool) $args['include_users'];
            }

            $result = $this->service->listUsergroups($params);

            return ToolResult::success([
                'ok' => true,
                'usergroups' => $result['usergroups'] ?? [],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

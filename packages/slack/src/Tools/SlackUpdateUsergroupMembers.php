<?php

namespace OpenCompany\Integrations\Slack\Tools;

use OpenCompany\Integrations\Slack\SlackService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update the members of a Slack usergroup.
 */
class SlackUpdateUsergroupMembers implements Tool
{
    /**
     * @param  SlackService  $service  The Slack API client
     */
    public function __construct(
        private SlackService $service,
    ) {}

    public function name(): string
    {
        return 'slack_update_usergroup_members';
    }

    public function description(): string
    {
        return 'Update the members of a Slack usergroup.';
    }

    public function parameters(): array
    {
        return [
            'usergroup' => ['type' => 'string', 'required' => true, 'description' => 'Usergroup ID.'],
            'users' => ['type' => 'string', 'required' => true, 'description' => 'Comma-separated list of user IDs to set as members.'],
        ];
    }

    /**
     * Set the member list for a usergroup.
     *
     * @param  array<string, mixed>  $args  Tool arguments (usergroup, users)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Slack integration is not configured.');
            }

            $usergroup = $args['usergroup'] ?? '';
            $users = $args['users'] ?? '';

            if (empty($usergroup)) {
                return ToolResult::error('usergroup is required.');
            }
            if (empty($users)) {
                return ToolResult::error('users is required.');
            }

            $result = $this->service->updateUsergroupMembers([
                'usergroup' => $usergroup,
                'users' => $users,
            ]);

            return ToolResult::success([
                'ok' => true,
                'usergroup' => $result['usergroup'] ?? [],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

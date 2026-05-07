<?php

namespace OpenCompany\Integrations\Pushover\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Pushover\PushoverService;

/**
 * Remove a user from a Pushover team using a Teams API token.
 */
class PushoverRemoveTeamUser implements Tool
{
    /**
     * @param  PushoverService  $service  The Pushover API client.
     */
    public function __construct(
        private PushoverService $service,
    ) {}

    public function name(): string
    {
        return 'pushover_remove_team_user';
    }

    public function description(): string
    {
        return 'Remove a user from a Pushover team by email address. Requires the optional team_token credential.';
    }

    public function parameters(): array
    {
        return [
            'email' => ['type' => 'string', 'required' => true, 'description' => 'Email address of the team user to remove.'],
        ];
    }

    /**
     * Remove a user from a Pushover team.
     *
     * @param  array<string, mixed>  $args  Tool arguments (email).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isTeamConfigured()) {
                return ToolResult::error('Pushover team_token credential is not configured.');
            }

            $email = $args['email'] ?? '';
            if ($email === '') {
                return ToolResult::error('email is required.');
            }

            return ToolResult::success($this->service->removeTeamUser($email));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

<?php

namespace OpenCompany\Integrations\Pushover\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Pushover\PushoverService;

/**
 * Add a user to a Pushover team using a Teams API token.
 */
class PushoverAddTeamUser implements Tool
{
    /**
     * @param  PushoverService  $service  The Pushover API client.
     */
    public function __construct(
        private PushoverService $service,
    ) {}

    public function name(): string
    {
        return 'pushover_add_team_user';
    }

    public function description(): string
    {
        return 'Add a user to a Pushover team. Requires the optional team_token credential.';
    }

    public function parameters(): array
    {
        return [
            'email' => ['type' => 'string', 'required' => true, 'description' => 'Email address for the team user.'],
            'name' => ['type' => 'string', 'description' => 'Optional full name.'],
            'password' => ['type' => 'string', 'description' => 'Optional initial password. If omitted, Pushover assigns and emails a random password.'],
            'instant' => ['type' => 'boolean', 'description' => 'Include an Instant Login link in the welcome email.'],
            'admin' => ['type' => 'boolean', 'description' => 'Add the user as a team administrator.'],
            'group' => ['type' => 'string', 'description' => 'Optional team delivery group name to add the user to.'],
        ];
    }

    /**
     * Add a user to a Pushover team.
     *
     * @param  array<string, mixed>  $args  Tool arguments (email, name, password, instant, admin, group).
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

            $data = ['email' => $email];
            foreach (['name', 'password', 'group'] as $key) {
                if (! empty($args[$key])) {
                    $data[$key] = $args[$key];
                }
            }
            foreach (['instant', 'admin'] as $key) {
                if (isset($args[$key])) {
                    $data[$key] = (bool) $args[$key] ? 'true' : 'false';
                }
            }

            return ToolResult::success($this->service->addTeamUser($data));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

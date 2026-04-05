<?php

namespace OpenCompany\Integrations\Slack\Tools;

use OpenCompany\Integrations\Slack\SlackService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Look up a Slack user by email address.
 */
class SlackFindUserByEmail implements Tool
{
    /**
     * @param  SlackService  $service  The Slack API client
     */
    public function __construct(
        private SlackService $service,
    ) {}

    public function name(): string
    {
        return 'slack_find_user_by_email';
    }

    public function description(): string
    {
        return 'Look up a Slack user by their email address.';
    }

    public function parameters(): array
    {
        return [
            'email' => ['type' => 'string', 'required' => true, 'description' => 'Email address to look up.'],
        ];
    }

    /**
     * Find a user by their email address.
     *
     * @param  array<string, mixed>  $args  Tool arguments (email)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Slack integration is not configured.');
            }

            $email = $args['email'] ?? '';

            if (empty($email)) {
                return ToolResult::error('email is required.');
            }

            $result = $this->service->findUserByEmail(['email' => $email]);

            return ToolResult::success([
                'ok' => true,
                'user' => $result['user'] ?? [],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

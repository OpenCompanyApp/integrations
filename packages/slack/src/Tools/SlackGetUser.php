<?php

namespace OpenCompany\Integrations\Slack\Tools;

use OpenCompany\Integrations\Slack\SlackService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get detailed information about a Slack user by their user ID.
 */
class SlackGetUser implements Tool
{
    /**
     * @param  SlackService  $service  The Slack API client
     */
    public function __construct(
        private SlackService $service,
    ) {}

    public function name(): string
    {
        return 'slack_get_user';
    }

    public function description(): string
    {
        return 'Get detailed information about a Slack user by their user ID.';
    }

    public function parameters(): array
    {
        return [
            'user' => ['type' => 'string', 'required' => true, 'description' => 'User ID.'],
        ];
    }

    /**
     * Get user info by user ID.
     *
     * @param  array<string, mixed>  $args  Tool arguments (user)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Slack integration is not configured.');
            }

            $user = $args['user'] ?? '';

            if (empty($user)) {
                return ToolResult::error('user (user ID) is required.');
            }

            $result = $this->service->getUser(['user' => $user]);

            return ToolResult::success([
                'ok' => true,
                'user' => $result['user'] ?? [],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

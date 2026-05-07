<?php

namespace OpenCompany\Integrations\Gotify\Tools;

use OpenCompany\Integrations\Gotify\GotifyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get the current Gotify user with a client token.
 */
class GotifyGetCurrentUser implements Tool
{
    /**
     * @param  GotifyService  $service  The Gotify API client.
     */
    public function __construct(
        private GotifyService $service,
    ) {}

    public function name(): string
    {
        return 'gotify_get_current_user';
    }

    public function description(): string
    {
        return 'Get information about the currently authenticated Gotify user, including username and admin status.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Fetch the currently authenticated Gotify user.
     *
     * @param  array<string, mixed>  $args  Tool arguments; none are required.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isClientConfigured()) {
                return ToolResult::error('Gotify client token is not configured. Current-user lookup requires a client token.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

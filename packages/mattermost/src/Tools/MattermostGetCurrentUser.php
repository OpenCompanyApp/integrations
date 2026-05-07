<?php

namespace OpenCompany\Integrations\Mattermost\Tools;

use OpenCompany\Integrations\Mattermost\MattermostService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get the currently authenticated Mattermost user profile.
 *
 * Returns the user object including id, username, email, nickname,
 * first_name, last_name, roles, and locale.
 */
class MattermostGetCurrentUser implements Tool
{
    /**
     * @param  MattermostService  $service  Mattermost API client.
     */
    public function __construct(
        private MattermostService $service,
    ) {}

    public function name(): string
    {
        return 'mattermost_get_current_user';
    }

    public function description(): string
    {
        return 'Get the profile of the currently authenticated Mattermost user. Returns username, email, display name, roles, and locale.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Get the current Mattermost user.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Mattermost integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

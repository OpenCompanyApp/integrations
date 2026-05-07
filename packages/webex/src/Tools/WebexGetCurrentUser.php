<?php

namespace OpenCompany\Integrations\Webex\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get the authenticated Webex user's profile.
 */
class WebexGetCurrentUser extends AbstractWebexTool implements Tool
{
    public function name(): string
    {
        return 'webex_get_current_user';
    }

    public function description(): string
    {
        return 'Get the profile of the currently authenticated Webex user. Returns display name, email, avatar, and account details. Useful for identifying which account the integration is connected to.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Fetch the current user profile.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if ($error = $this->requireConfigured()) {
                return $error;
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

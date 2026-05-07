<?php

namespace OpenCompany\Integrations\Phantombuster\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get the authenticated Phantombuster user.
 */
class PhantombusterGetCurrentUser extends AbstractPhantombusterTool implements Tool
{
    public function name(): string
    {
        return 'phantombuster_get_current_user';
    }

    public function description(): string
    {
        return 'Get the authenticated Phantombuster user profile, including account info and plan details.';
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

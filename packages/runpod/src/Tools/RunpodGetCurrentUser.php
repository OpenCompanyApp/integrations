<?php

namespace OpenCompany\Integrations\Runpod\Tools;

use OpenCompany\Integrations\Runpod\RunpodService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get the currently authenticated RunPod user's profile.
 *
 * Returns user details like name, email, and account information.
 */
class RunpodGetCurrentUser implements Tool
{
    public function __construct(
        private RunpodService $service,
    ) {}

    public function name(): string
    {
        return 'runpod_get_current_user';
    }

    public function description(): string
    {
        return 'Get the profile of the currently authenticated RunPod user, including name, email, and account details.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('RunPod integration is not configured.');
            }

            $user = $this->service->getCurrentUser();

            return ToolResult::success($user);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

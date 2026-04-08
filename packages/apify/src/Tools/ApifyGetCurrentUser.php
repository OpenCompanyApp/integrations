<?php

namespace OpenCompany\Integrations\Apify\Tools;

use OpenCompany\Integrations\Apify\ApifyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get the profile of the currently authenticated Apify user.
 *
 * Returns the user's ID, username, email, plan, and usage information.
 * Useful for verifying API connectivity and checking account details.
 */
class ApifyGetCurrentUser implements Tool
{
    public function __construct(
        private ApifyService $service,
    ) {}

    public function name(): string
    {
        return 'apify_get_current_user';
    }

    public function description(): string
    {
        return 'Get the profile of the currently authenticated Apify user. Returns user ID, username, email, plan details, and monthly usage information.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Apify integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            $data = $result['data'] ?? $result;

            return ToolResult::success([
                'id' => $data['id'] ?? null,
                'username' => $data['username'] ?? null,
                'email' => $data['email'] ?? null,
                'name' => $data['name'] ?? null,
                'plan' => $data['plan'] ?? null,
                'monthlyUsageUsd' => $data['monthlyUsageUsd'] ?? null,
                'monthlyBaseLimitUsd' => $data['monthlyBaseLimitUsd'] ?? null,
                'profile' => $data['profile'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

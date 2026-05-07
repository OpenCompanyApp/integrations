<?php

namespace OpenCompany\Integrations\LaunchDarkly\Tools;

use OpenCompany\Integrations\LaunchDarkly\LaunchDarklyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get the currently authenticated LaunchDarkly member.
 */
class LaunchDarklyGetCurrentUser implements Tool
{
    /**
     * @param  LaunchDarklyService  $service  LaunchDarkly API client.
     */
    public function __construct(
        private LaunchDarklyService $service,
    ) {}

    public function name(): string
    {
        return 'launchdarkly_get_current_user';
    }

    public function description(): string
    {
        return 'Get information about the currently authenticated LaunchDarkly user. Useful for verifying API credentials.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Get current member details from LaunchDarkly.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('LaunchDarkly integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            $member = $result['member'] ?? $result;

            return ToolResult::success([
                'id' => $member['_id'] ?? $member['id'] ?? null,
                'email' => $member['email'] ?? '',
                'first_name' => $member['firstName'] ?? '',
                'last_name' => $member['lastName'] ?? '',
                'role' => $member['role'] ?? '',
                'pending' => $member['pending'] ?? false,
                'is_beta' => $member['isBeta'] ?? false,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

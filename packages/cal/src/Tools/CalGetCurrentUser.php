<?php

namespace OpenCompany\Integrations\Cal\Tools;

use OpenCompany\Integrations\Cal\CalService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get the currently authenticated Cal.com user's profile.
 *
 * Returns user information including name, email, username,
 * time zone, and default schedule.
 *
 * @see https://cal.com/docs/api-reference/v2/me/get-my-profile
 */
class CalGetCurrentUser implements Tool
{
    /**
     * @param  CalService  $service  Cal.com API client.
     */
    public function __construct(
        private CalService $service,
    ) {}

    public function name(): string
    {
        return 'cal_get_current_user';
    }

    public function description(): string
    {
        return 'Get the authenticated Cal.com user\'s profile information, including name, email, and time zone.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the tool — get the current user profile from Cal.com.
     *
     * @param  array<string, mixed>  $args  Tool arguments (unused).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Cal.com integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

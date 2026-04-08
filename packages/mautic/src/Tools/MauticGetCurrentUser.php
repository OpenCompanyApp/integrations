<?php

namespace OpenCompany\Integrations\Mautic\Tools;

use OpenCompany\Integrations\Mautic\MauticService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * MauticGetCurrentUser — Get the currently authenticated Mautic user.
 *
 * Calls GET /api/users/me and returns the user profile.
 *
 * @see https://developer.mautic.org/#get-self-user
 */
class MauticGetCurrentUser implements Tool
{
    /**
     * @param  MauticService  $service  The Mautic API service instance.
     */
    public function __construct(
        private MauticService $service,
    ) {}

    /**
     * The tool identifier used in the registry.
     */
    public function name(): string
    {
        return 'mautic_get_current_user';
    }

    /**
     * Human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Get details of the currently authenticated Mautic user — useful to verify credentials and identify which user the integration is acting as.';
    }

    /**
     * Parameter schema for the tool.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the tool — fetch the current user from Mautic.
     *
     * @param  array<string, mixed>  $args  Tool arguments (none).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Mautic integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            $user = $result['user'] ?? $result;

            if (empty($user)) {
                return ToolResult::error('Could not retrieve current user. Check credentials.');
            }

            return ToolResult::success($user);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

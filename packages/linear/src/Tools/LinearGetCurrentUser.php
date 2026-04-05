<?php

namespace OpenCompany\Integrations\Linear\Tools;

use OpenCompany\Integrations\Linear\LinearService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve the currently authenticated Linear user's profile.
 */
class LinearGetCurrentUser implements Tool
{
    /**
     * @param  LinearService  $service  The Linear API client
     */
    public function __construct(
        private LinearService $service,
    ) {}

    public function name(): string
    {
        return 'linear_get_current_user';
    }

    public function description(): string
    {
        return <<<'MD'
        Get the currently authenticated Linear user's profile, including
        ID, name, email, and avatar URL.
        MD;
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Fetch the authenticated Linear user profile.
     *
     * @param  array<string, mixed>  $args  Tool arguments (unused)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Linear integration is not configured.');
            }

            $result = $this->service->getCurrentUser();
            $viewer = $result['data']['viewer'] ?? null;

            if ($viewer === null) {
                return ToolResult::error('Failed to retrieve current user.');
            }

            return ToolResult::success([
                'id' => $viewer['id'] ?? '',
                'name' => $viewer['name'] ?? '',
                'email' => $viewer['email'] ?? '',
                'avatar_url' => $viewer['avatarUrl'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

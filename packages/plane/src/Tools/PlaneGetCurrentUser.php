<?php

namespace OpenCompany\Integrations\Plane\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Plane\PlaneService;

/**
 * Get the current authenticated Plane.so user.
 */
class PlaneGetCurrentUser implements Tool
{
    /**
     * @param  PlaneService  $service  The Plane.so API client
     */
    public function __construct(
        private PlaneService $service,
    ) {}

    public function name(): string
    {
        return 'plane_get_current_user';
    }

    public function description(): string
    {
        return <<<'DESC'
Get the currently authenticated Plane.so user. Returns user ID, display name, email, and avatar.
Useful for verifying API credentials and identifying the current user context.
On some self-hosted Plane deployments where the user endpoint is unavailable, this falls back to verifying workspace-scoped access.
DESC;
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * @param  array<string, mixed>  $args
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Plane.so integration is not configured.');
            }

            $user = $this->service->getCurrentUser();

            return ToolResult::success([
                'id' => $user['id'] ?? null,
                'display_name' => $user['display_name'] ?? null,
                'email' => $user['email'] ?? null,
                'avatar' => $user['avatar'] ?? null,
                'workspace_slug' => $user['workspace_slug'] ?? null,
                'source' => $user['workspace_slug'] ?? null ? 'workspace_probe' : 'user_endpoint',
                'is_active' => $user['is_active'] ?? null,
                'is_tour_completed' => $user['is_tour_completed'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

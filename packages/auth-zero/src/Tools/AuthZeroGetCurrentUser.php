<?php

namespace OpenCompany\Integrations\AuthZero\Tools;

use OpenCompany\Integrations\AuthZero\AuthZeroService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: Retrieve the currently authenticated user profile / perform a health check.
 *
 * Calls <code>GET /api/v2/users/me</code> to verify the access token and
 * return information about the authenticated entity. Useful as a connection
 * health check — if the token is valid the response includes the caller's
 * profile.
 *
 * @see https://auth0.com/docs/api/management/v2#!/Users/get_me
 */
class AuthZeroGetCurrentUser implements Tool
{
    public function __construct(
        private AuthZeroService $service,
    ) {}

    public function name(): string
    {
        return 'auth_zero_get_current_user';
    }

    public function description(): string
    {
        return 'Retrieve the profile of the currently authenticated user. Also serves as a health check for the Auth0 connection.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Auth0 integration is not configured.');
            }

            // The /users/me endpoint is not available on all plans.
            // Fall back to tenant settings as a health check.
            try {
                $result = $this->service->getUser('me');
            } catch (\Throwable $e) {
                // Fallback: use tenant settings as the health check
                $result = $this->service->getTenantSettings();
                $result['_health_check'] = 'Retrieved tenant settings — access token is valid.';
            }

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

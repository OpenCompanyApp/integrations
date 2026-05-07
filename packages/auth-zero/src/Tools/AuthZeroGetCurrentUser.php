<?php

namespace OpenCompany\Integrations\AuthZero\Tools;

use OpenCompany\Integrations\AuthZero\AuthZeroService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: Perform an Auth0 Management API health check.
 *
 * Uses tenant settings because Management API access tokens are often issued to
 * machine-to-machine clients rather than Auth0 users.
 */
class AuthZeroGetCurrentUser implements Tool
{
    /**
     * @param  AuthZeroService  $service  The Auth0 Management API client.
     */
    public function __construct(
        private AuthZeroService $service,
    ) {}

    public function name(): string
    {
        return 'auth_zero_get_current_user';
    }

    public function description(): string
    {
        return 'Run a lightweight Auth0 Management API health check by retrieving tenant settings.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Run the Auth0 Management API health check.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Auth0 integration is not configured.');
            }

            $result = $this->service->healthCheck();
            $result['_health_check'] = 'Retrieved tenant settings; Management API token is valid for this tenant.';

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

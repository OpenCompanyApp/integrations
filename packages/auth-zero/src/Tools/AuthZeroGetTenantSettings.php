<?php

namespace OpenCompany\Integrations\AuthZero\Tools;

use OpenCompany\Integrations\AuthZero\AuthZeroService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: Retrieve the Auth0 tenant settings.
 *
 * Maps to <code>GET /api/v2/tenants/settings</code>.
 *
 * @see https://auth0.com/docs/api/management/v2#!/Tenants/get_settings
 */
class AuthZeroGetTenantSettings implements Tool
{
    public function __construct(
        private AuthZeroService $service,
    ) {}

    public function name(): string
    {
        return 'auth_zero_get_tenant_settings';
    }

    public function description(): string
    {
        return 'Retrieve the Auth0 tenant settings (session lifetime, idle timeout, default directory, etc.).';
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

            $result = $this->service->getTenantSettings();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

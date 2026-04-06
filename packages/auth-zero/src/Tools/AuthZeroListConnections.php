<?php

namespace OpenCompany\Integrations\AuthZero\Tools;

use OpenCompany\Integrations\AuthZero\AuthZeroService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: List identity connections configured in the Auth0 tenant.
 *
 * Optionally filter by strategy (e.g. "auth0", "google-oauth2", "samlp").
 * Maps to <code>GET /api/v2/connections</code>.
 *
 * @see https://auth0.com/docs/api/management/v2#!/Connections/get_connections
 */
class AuthZeroListConnections implements Tool
{
    public function __construct(
        private AuthZeroService $service,
    ) {}

    public function name(): string
    {
        return 'auth_zero_list_connections';
    }

    public function description(): string
    {
        return 'List identity connections configured in the Auth0 tenant. Optionally filter by strategy (e.g. "auth0", "google-oauth2").';
    }

    public function parameters(): array
    {
        return [
            'strategy' => ['type' => 'string', 'description' => 'Filter by connection strategy (e.g. "auth0", "google-oauth2", "samlp", "oidc").'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Auth0 integration is not configured.');
            }

            $params = [];
            if (isset($args['strategy']) && $args['strategy'] !== '') {
                $params['strategy'] = $args['strategy'];
            }

            $result = $this->service->listConnections($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

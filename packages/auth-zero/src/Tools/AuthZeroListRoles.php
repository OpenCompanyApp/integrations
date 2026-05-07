<?php

namespace OpenCompany\Integrations\AuthZero\Tools;

use OpenCompany\Integrations\AuthZero\AuthZeroService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: List roles defined in the Auth0 tenant.
 *
 * Maps to <code>GET /api/v2/roles</code>.
 *
 * @see https://auth0.com/docs/api/management/v2#!/Roles/get_roles
 */
class AuthZeroListRoles implements Tool
{
    /**
     * @param  AuthZeroService  $service  The Auth0 Management API client.
     */
    public function __construct(
        private AuthZeroService $service,
    ) {}

    public function name(): string
    {
        return 'auth_zero_list_roles';
    }

    public function description(): string
    {
        return 'List roles defined in the Auth0 tenant with optional pagination.';
    }

    public function parameters(): array
    {
        return [
            'page'     => ['type' => 'integer', 'description' => 'Page index (zero-based). Default: 0.'],
            'per_page' => ['type' => 'integer', 'description' => 'Number of results per page. Default: 50.'],
        ];
    }

    /**
     * List Auth0 roles with optional pagination.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Auth0 integration is not configured.');
            }

            $params = [];
            if (isset($args['page'])) {
                $params['page'] = (int) $args['page'];
            }
            if (isset($args['per_page'])) {
                $params['per_page'] = (int) $args['per_page'];
            }

            $result = $this->service->getRoles($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

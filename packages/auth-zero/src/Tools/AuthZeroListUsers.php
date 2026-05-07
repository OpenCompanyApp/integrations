<?php

namespace OpenCompany\Integrations\AuthZero\Tools;

use OpenCompany\Integrations\AuthZero\AuthZeroService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: List users in the Auth0 tenant.
 *
 * Supports pagination and Lucene-based search queries via the <code>q</code>
 * parameter. Maps to <code>GET /api/v2/users</code>.
 *
 * @see https://auth0.com/docs/api/management/v2#!/Users/get_users
 */
class AuthZeroListUsers implements Tool
{
    /**
     * @param  AuthZeroService  $service  The Auth0 Management API client.
     */
    public function __construct(
        private AuthZeroService $service,
    ) {}

    public function name(): string
    {
        return 'auth_zero_list_users';
    }

    public function description(): string
    {
        return 'List users in the Auth0 tenant. Supports search with Lucene syntax, pagination, and sorting.';
    }

    public function parameters(): array
    {
        return [
            'page'     => ['type' => 'integer', 'description' => 'Page index (zero-based). Default: 0.'],
            'per_page' => ['type' => 'integer', 'description' => 'Number of results per page. Default: 50, max: 100.'],
            'q'        => ['type' => 'string',  'description' => 'Lucene search query (e.g. "email:*@example.com").'],
            'sort'     => ['type' => 'string',  'description' => 'Field to sort by, with optional direction (e.g. "created_at:-1" or "name:1").'],
        ];
    }

    /**
     * List Auth0 users with optional search, sorting, and pagination.
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
            if (isset($args['q'])) {
                $params['q'] = $args['q'];
            }
            if (isset($args['sort'])) {
                $params['sort'] = $args['sort'];
            }

            $result = $this->service->listUsers($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

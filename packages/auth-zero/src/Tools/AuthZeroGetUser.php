<?php

namespace OpenCompany\Integrations\AuthZero\Tools;

use OpenCompany\Integrations\AuthZero\AuthZeroService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: Retrieve a single Auth0 user by ID.
 *
 * Maps to <code>GET /api/v2/users/{id}</code>.
 *
 * @see https://auth0.com/docs/api/management/v2#!/Users/get_users_by_id
 */
class AuthZeroGetUser implements Tool
{
    /**
     * @param  AuthZeroService  $service  The Auth0 Management API client.
     */
    public function __construct(
        private AuthZeroService $service,
    ) {}

    public function name(): string
    {
        return 'auth_zero_get_user';
    }

    public function description(): string
    {
        return 'Retrieve a single Auth0 user by their user ID (e.g. "auth0|abc123").';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The Auth0 user identifier (e.g. "auth0|abc123", "google-oauth2|xyz").'],
        ];
    }

    /**
     * Retrieve a single Auth0 user by user ID.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Auth0 integration is not configured.');
            }

            $id = $args['id'] ?? '';
            if (empty($id)) {
                return ToolResult::error('The "id" parameter is required.');
            }

            $result = $this->service->getUser($id);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

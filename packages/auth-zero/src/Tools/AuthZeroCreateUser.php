<?php

namespace OpenCompany\Integrations\AuthZero\Tools;

use OpenCompany\Integrations\AuthZero\AuthZeroService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: Create a new user in Auth0.
 *
 * Maps to <code>POST /api/v2/users</code>. Requires email, password, and the
 * name of the database connection to create the user in.
 *
 * @see https://auth0.com/docs/api/management/v2#!/Users/post_users
 */
class AuthZeroCreateUser implements Tool
{
    /**
     * @param  AuthZeroService  $service  The Auth0 Management API client.
     */
    public function __construct(
        private AuthZeroService $service,
    ) {}

    public function name(): string
    {
        return 'auth_zero_create_user';
    }

    public function description(): string
    {
        return 'Create a new user in Auth0. Requires email, password, and the connection name (database connection).';
    }

    public function parameters(): array
    {
        return [
            'email'      => ['type' => 'string',  'required' => true, 'description' => 'Email address for the new user.'],
            'password'   => ['type' => 'string',  'required' => true, 'description' => 'Password for the new user (must meet connection requirements).'],
            'connection' => ['type' => 'string',  'required' => true, 'description' => 'The database connection name to create the user in (e.g. "Username-Password-Authentication").'],
            'name'       => ['type' => 'string',  'description' => 'Full name of the user.'],
        ];
    }

    /**
     * Create a new Auth0 database-connection user.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Auth0 integration is not configured.');
            }

            $email = $args['email'] ?? '';
            $password = $args['password'] ?? '';
            $connection = $args['connection'] ?? '';

            if (empty($email)) {
                return ToolResult::error('The "email" parameter is required.');
            }
            if (empty($password)) {
                return ToolResult::error('The "password" parameter is required.');
            }
            if (empty($connection)) {
                return ToolResult::error('The "connection" parameter is required.');
            }

            $data = [
                'email'      => $email,
                'password'   => $password,
                'connection' => $connection,
            ];

            if (isset($args['name']) && $args['name'] !== '') {
                $data['name'] = $args['name'];
            }

            $result = $this->service->createUser($data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

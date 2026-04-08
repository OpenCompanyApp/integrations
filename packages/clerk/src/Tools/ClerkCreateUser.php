<?php

namespace OpenCompany\Integrations\Clerk\Tools;

use OpenCompany\Integrations\Clerk\ClerkService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class ClerkCreateUser implements Tool
{
    /**
     * Create a new ClerkCreateUser tool instance.
     */
    public function __construct(
        private ClerkService $service,
    ) {}

    /**
     * Get the tool name.
     */
    public function name(): string
    {
        return 'clerk_create_user';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'Create a new user in Clerk. Requires at least one email address. Optionally set name, password, and username.';
    }

    /**
     * Get the tool parameters schema.
     *
     * @return array<string, array{type: string, description?: string, required?: bool}>
     */
    public function parameters(): array
    {
        return [
            'email_address' => ['type' => 'array', 'required' => true, 'description' => 'Array of email addresses for the user. At least one is required.'],
            'first_name' => ['type' => 'string', 'description' => 'The user\'s first name.'],
            'last_name' => ['type' => 'string', 'description' => 'The user\'s last name.'],
            'password' => ['type' => 'string', 'description' => 'The user\'s password. Minimum 8 characters.'],
            'username' => ['type' => 'string', 'description' => 'The user\'s username.'],
        ];
    }

    /**
     * Execute the create user tool.
     *
     * @param  array  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Clerk integration is not configured.');
            }

            if (empty($args['email_address']) || !is_array($args['email_address'])) {
                return ToolResult::error('At least one email address is required to create a user.');
            }

            $data = [
                'email_address' => $args['email_address'],
            ];

            if (isset($args['first_name'])) {
                $data['first_name'] = $args['first_name'];
            }
            if (isset($args['last_name'])) {
                $data['last_name'] = $args['last_name'];
            }
            if (isset($args['password'])) {
                $data['password'] = $args['password'];
            }
            if (isset($args['username'])) {
                $data['username'] = $args['username'];
            }

            $result = $this->service->createUser($data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

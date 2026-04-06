<?php

namespace OpenCompany\Integrations\Clerk\Tools;

use OpenCompany\Integrations\Clerk\ClerkService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class ClerkUpdateUser implements Tool
{
    /**
     * Create a new ClerkUpdateUser tool instance.
     */
    public function __construct(
        private ClerkService $service,
    ) {}

    /**
     * Get the tool name.
     */
    public function name(): string
    {
        return 'clerk_update_user';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'Update an existing Clerk user\'s profile. Provide the user ID and fields to update.';
    }

    /**
     * Get the tool parameters schema.
     *
     * @return array<string, array{type: string, description?: string, required?: bool}>
     */
    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The Clerk user ID to update (e.g., "user_2abc123").'],
            'first_name' => ['type' => 'string', 'description' => 'Updated first name.'],
            'last_name' => ['type' => 'string', 'description' => 'Updated last name.'],
            'username' => ['type' => 'string', 'description' => 'Updated username.'],
        ];
    }

    /**
     * Execute the update user tool.
     *
     * @param  array  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Clerk integration is not configured.');
            }

            if (empty($args['id'])) {
                return ToolResult::error('User ID is required.');
            }

            $data = [];

            if (isset($args['first_name'])) {
                $data['first_name'] = $args['first_name'];
            }
            if (isset($args['last_name'])) {
                $data['last_name'] = $args['last_name'];
            }
            if (isset($args['username'])) {
                $data['username'] = $args['username'];
            }

            if (empty($data)) {
                return ToolResult::error('At least one field (first_name, last_name, or username) must be provided to update.');
            }

            $result = $this->service->updateUser($args['id'], $data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

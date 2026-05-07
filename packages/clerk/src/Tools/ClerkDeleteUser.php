<?php

namespace OpenCompany\Integrations\Clerk\Tools;

use OpenCompany\Integrations\Clerk\ClerkService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Delete a Clerk user.
 *
 * Removes a user and associated Clerk data by user ID.
 */
class ClerkDeleteUser implements Tool
{
    /**
     * Create a new ClerkDeleteUser tool instance.
     *
     * @param  ClerkService  $service  Clerk Backend API client.
     */
    public function __construct(
        private ClerkService $service,
    ) {}

    /**
     * Get the tool name.
     */
    public function name(): string
    {
        return 'clerk_delete_user';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'Delete a user from Clerk. This action is irreversible and will remove all associated data.';
    }

    /**
     * Get the tool parameters schema.
     *
     * @return array<string, array{type: string, description?: string, required?: bool}>
     */
    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The Clerk user ID to delete (e.g., "user_2abc123").'],
        ];
    }

    /**
     * Execute the delete user tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
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

            $this->service->deleteUser($args['id']);

            return ToolResult::success("User '{$args['id']}' has been deleted.");
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

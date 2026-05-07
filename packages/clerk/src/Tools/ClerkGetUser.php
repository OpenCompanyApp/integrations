<?php

namespace OpenCompany\Integrations\Clerk\Tools;

use OpenCompany\Integrations\Clerk\ClerkService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve a Clerk user.
 *
 * Returns the Backend API user object for one user ID.
 */
class ClerkGetUser implements Tool
{
    /**
     * Create a new ClerkGetUser tool instance.
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
        return 'clerk_get_user';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'Retrieve a single Clerk user by their user ID. Returns full profile details including email, name, and metadata.';
    }

    /**
     * Get the tool parameters schema.
     *
     * @return array<string, array{type: string, description?: string, required?: bool}>
     */
    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The Clerk user ID (e.g., "user_2abc123").'],
        ];
    }

    /**
     * Execute the get user tool.
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

            $result = $this->service->getUser($args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

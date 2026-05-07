<?php

namespace OpenCompany\Integrations\Clerk\Tools;

use OpenCompany\Integrations\Clerk\ClerkService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Clerk users.
 *
 * Supports pagination and common user search filters.
 */
class ClerkListUsers implements Tool
{
    /**
     * Create a new ClerkListUsers tool instance.
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
        return 'clerk_list_users';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'List users from Clerk with optional filtering and pagination. Returns user IDs, emails, names, and profile details.';
    }

    /**
     * Get the tool parameters schema.
     *
     * @return array<string, array{type: string, description?: string, required?: bool}>
     */
    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of users to return (default: 10, max: 500).'],
            'offset' => ['type' => 'integer', 'description' => 'Number of users to skip for pagination.'],
            'email_address' => ['type' => 'string', 'description' => 'Filter users by email address.'],
            'phone_number' => ['type' => 'string', 'description' => 'Filter users by phone number.'],
            'query' => ['type' => 'string', 'description' => 'Search query to filter users by name, email, or username.'],
            'order_by' => ['type' => 'string', 'description' => 'Sort order for results. Use "+created_at" for ascending or "-created_at" for descending (default: "+created_at").'],
        ];
    }

    /**
     * Execute the list users tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Clerk integration is not configured.');
            }

            $params = [];

            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }
            if (isset($args['offset'])) {
                $params['offset'] = (int) $args['offset'];
            }
            if (isset($args['email_address'])) {
                $params['email_address'] = $args['email_address'];
            }
            if (isset($args['phone_number'])) {
                $params['phone_number'] = $args['phone_number'];
            }
            if (isset($args['query'])) {
                $params['query'] = $args['query'];
            }
            if (isset($args['order_by'])) {
                $params['order_by'] = $args['order_by'];
            }

            $result = $this->service->listUsers($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

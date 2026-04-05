<?php

namespace OpenCompany\Integrations\Zoom\Tools;

use OpenCompany\Integrations\Zoom\ZoomService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List users in a Zoom account.
 *
 * Retrieves all users with optional filtering by status, role,
 * and pagination support.
 */
class ZoomListUsers implements Tool
{
    /**
     * @param  ZoomService  $service  The Zoom API client
     */
    public function __construct(
        private ZoomService $service,
    ) {}

    public function name(): string
    {
        return 'zoom_list_users';
    }

    public function description(): string
    {
        return 'List users in the Zoom account. Filter by status and role with pagination.';
    }

    public function parameters(): array
    {
        return [
            'status'          => ['type' => 'string', 'description' => 'User status filter: "active", "inactive", "pending". Default: "active".'],
            'role_id'         => ['type' => 'string', 'description' => 'Filter by role ID.'],
            'page_size'       => ['type' => 'integer', 'description' => 'Number of records returned per page (default 30, max 300).'],
            'next_page_token' => ['type' => 'string', 'description' => 'Token for the next page of results.'],
        ];
    }

    /**
     * List users in the account.
     *
     * @param  array<string, mixed>  $args  Tool arguments (status, role_id, page_size, next_page_token)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Zoom integration is not configured.');
            }

            $params = [];

            if (isset($args['status'])) {
                $params['status'] = $args['status'];
            }
            if (isset($args['role_id'])) {
                $params['role_id'] = $args['role_id'];
            }
            if (isset($args['page_size'])) {
                $params['page_size'] = (int) $args['page_size'];
            }
            if (isset($args['next_page_token'])) {
                $params['next_page_token'] = $args['next_page_token'];
            }

            $result = $this->service->listUsers($params);

            return ToolResult::success([
                'users' => $result['users'] ?? [],
                'page_count' => $result['page_count'] ?? 0,
                'total_records' => $result['total_records'] ?? 0,
                'next_page_token' => $result['next_page_token'] ?? '',
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

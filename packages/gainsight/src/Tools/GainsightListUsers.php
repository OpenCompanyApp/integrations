<?php

namespace OpenCompany\Integrations\Gainsight\Tools;

use OpenCompany\Integrations\Gainsight\GainsightService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool for listing users from Gainsight.
 *
 * Retrieves users in the Gainsight tenant with support for
 * filtering and pagination.
 */
class GainsightListUsers implements Tool
{
    /**
     * Create a new GainsightListUsers tool instance.
     */
    public function __construct(
        private GainsightService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'gainsight_list_users';
    }

    /**
     * Get the tool description for AI agent consumption.
     */
    public function description(): string
    {
        return 'List users in the Gainsight tenant. Returns user details including name, email, role, and last active date.';
    }

    /**
     * Get the tool parameter schema.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (starting from 1).'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of users to return (default: 50).'],
            'role' => ['type' => 'string', 'description' => 'Filter users by role (e.g., "Admin", "CSM", "Manager").'],
        ];
    }

    /**
     * Execute the list users tool.
     *
     * @param  array  $args  Tool arguments matching the parameter schema.
     * @return ToolResult The result containing user data or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Gainsight integration is not configured.');
            }

            $params = [];

            if (isset($args['page'])) {
                $params['page'] = $args['page'];
            }
            if (isset($args['limit'])) {
                $params['limit'] = $args['limit'];
            }
            if (isset($args['role'])) {
                $params['role'] = $args['role'];
            }

            $result = $this->service->listUsers($params);

            $users = $result['users'] ?? $result['data'] ?? [];
            $totalCount = count($users);
            $response = [
                'users' => $users,
                'count' => $totalCount,
            ];

            if (isset($result['totalRecords'])) {
                $response['totalRecords'] = $result['totalRecords'];
            }
            if (isset($result['total'])) {
                $response['totalRecords'] = $result['total'];
            }

            return ToolResult::success($response);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

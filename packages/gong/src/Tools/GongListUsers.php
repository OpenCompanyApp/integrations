<?php

namespace OpenCompany\Integrations\Gong\Tools;

use OpenCompany\Integrations\Gong\GongService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool for listing users from Gong.
 *
 * Retrieves users in the Gong workspace via the POST /v2/users endpoint,
 * supporting filtering and pagination.
 */
class GongListUsers implements Tool
{
    /**
     * Create a new GongListUsers tool instance.
     */
    public function __construct(
        private GongService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'gong_list_users';
    }

    /**
     * Get the tool description for AI agent consumption.
     */
    public function description(): string
    {
        return 'List users in the Gong workspace. Returns user details including name, email, title, and manager.';
    }

    /**
     * Get the tool parameter schema.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'cursor' => ['type' => 'string', 'description' => 'Cursor for pagination — pass the value from a previous response to get the next page.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of users to return (default: 100).'],
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
                return ToolResult::error('Gong integration is not configured.');
            }

            $body = [];

            if (isset($args['cursor'])) {
                $body['cursor'] = $args['cursor'];
            }

            $result = $this->service->listUsers($body);

            $users = $result['users'] ?? [];
            $totalCount = count($users);
            $response = [
                'users' => $users,
                'count' => $totalCount,
            ];

            if (isset($result['records'])) {
                $response['totalRecords'] = $result['records']['totalRecords'] ?? $totalCount;
            }
            if (isset($result['cursor'])) {
                $response['cursor'] = $result['cursor'];
            }

            return ToolResult::success($response);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

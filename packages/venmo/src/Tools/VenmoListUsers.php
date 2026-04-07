<?php

namespace OpenCompany\Integrations\Venmo\Tools;

use OpenCompany\Integrations\Venmo\VenmoService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Venmo users with optional filtering.
 *
 * Supports search by username, email, or phone and pagination.
 */
class VenmoListUsers implements Tool
{
    /**
     * @param  VenmoService  $service  The Venmo API client
     */
    public function __construct(
        private VenmoService $service,
    ) {}

    public function name(): string
    {
        return 'venmo_list_users';
    }

    public function description(): string
    {
        return <<<'MD'
        List Venmo users with optional filtering.
        Supports search by username, email, or phone and pagination.
        MD;
    }

    public function parameters(): array
    {
        return [
            'query' => ['type' => 'string', 'description' => 'Search query — username, email, or phone number.'],
            'limit' => ['type' => 'integer', 'description' => 'Number of users to return (default 20).'],
            'offset' => ['type' => 'integer', 'description' => 'Offset for pagination.'],
        ];
    }

    /**
     * List Venmo users with optional search and pagination.
     *
     * @param  array<string, mixed>  $args  Tool arguments (query, limit, offset)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Venmo integration is not configured.');
            }

            $params = [];

            if (isset($args['query'])) {
                $params['query'] = $args['query'];
            }
            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }
            if (isset($args['offset'])) {
                $params['offset'] = (int) $args['offset'];
            }

            $result = $this->service->listUsers($params);

            $users = array_map(function (array $u) {
                return [
                    'id' => $u['id'] ?? '',
                    'username' => $u['username'] ?? '',
                    'display_name' => $u['display_name'] ?? '',
                    'profile_picture_url' => $u['profile_picture_url'] ?? null,
                ];
            }, $result['data'] ?? []);

            return ToolResult::success([
                'users' => $users,
                'paging' => $result['paging'] ?? [],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

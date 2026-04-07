<?php

namespace OpenCompany\Integrations\Zendesk\Tools;

use OpenCompany\Integrations\Zendesk\ZendeskService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Zendesk users with pagination and filtering.
 *
 * Returns a paginated list of users with their IDs, names, emails, and roles.
 */
class ZendeskListUsers implements Tool
{
    /**
     * @param  ZendeskService  $service  The Zendesk API client
     */
    public function __construct(
        private ZendeskService $service,
    ) {}

    public function name(): string
    {
        return 'zendesk_list_users';
    }

    public function description(): string
    {
        return <<<'MD'
        List Zendesk users with pagination and filtering.
        Returns user IDs, names, emails, and roles.
        Use per_page, page, and role for pagination and filtering.
        MD;
    }

    public function parameters(): array
    {
        return [
            'per_page' => ['type' => 'integer', 'description' => 'Number of users per page (default 100, max 100).'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (1-indexed).'],
            'role' => ['type' => 'string', 'description' => 'Filter by role: "end-user", "agent", "admin".'],
            'sort_by' => ['type' => 'string', 'description' => 'Field to sort by (e.g. "name", "created_at").'],
            'sort_order' => ['type' => 'string', 'description' => 'Sort order: "asc" or "desc".'],
        ];
    }

    /**
     * List Zendesk users with optional pagination and filtering.
     *
     * @param  array<string, mixed>  $args  Tool arguments (per_page, page, role, sort_by, sort_order)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Zendesk integration is not configured.');
            }

            $params = [];

            if (isset($args['per_page'])) {
                $params['per_page'] = (int) $args['per_page'];
            }
            if (isset($args['page'])) {
                $params['page'] = (int) $args['page'];
            }
            if (! empty($args['role'])) {
                $params['role'] = $args['role'];
            }
            if (! empty($args['sort_by'])) {
                $params['sort_by'] = $args['sort_by'];
            }
            if (! empty($args['sort_order'])) {
                $params['sort_order'] = $args['sort_order'];
            }

            $result = $this->service->listUsers($params);

            $users = array_map(function (array $user): array {
                return [
                    'id' => $user['id'] ?? '',
                    'name' => $user['name'] ?? '',
                    'email' => $user['email'] ?? '',
                    'role' => $user['role'] ?? '',
                    'created_at' => $user['created_at'] ?? '',
                    'last_login_at' => $user['last_login_at'] ?? '',
                ];
            }, $result['users'] ?? []);

            $output = ['results' => $users];

            if (isset($result['next_page'])) {
                $output['next_page'] = $result['next_page'];
            }

            return ToolResult::success($output);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

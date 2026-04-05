<?php

namespace OpenCompany\Integrations\Zendesk\Tools;

use OpenCompany\Integrations\Zendesk\ZendeskService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Zendesk users with optional role filtering and pagination.
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
        return 'List Zendesk users with optional role filtering and pagination. Returns user IDs, names, emails, and roles.';
    }

    public function parameters(): array
    {
        return [
            'role' => ['type' => 'string', 'description' => 'Filter by role (end-user, agent, admin).'],
            'per_page' => ['type' => 'integer', 'description' => 'Number of users per page. Default: 100.'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination.'],
        ];
    }

    /**
     * List Zendesk users with optional filtering.
     *
     * @param  array<string, mixed>  $args  Tool arguments (role, per_page, page)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('Zendesk is not configured. Missing email, API token, or subdomain.');
        }

        try {
            $params = [];

            if (isset($args['role'])) {
                $params['role'] = $args['role'];
            }

            if (isset($args['per_page'])) {
                $params['per_page'] = (int) $args['per_page'];
            }

            if (isset($args['page'])) {
                $params['page'] = (int) $args['page'];
            }

            $result = $this->service->listUsers($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

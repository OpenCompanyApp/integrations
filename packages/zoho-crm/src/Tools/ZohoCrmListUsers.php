<?php

namespace OpenCompany\Integrations\ZohoCrm\Tools;

use OpenCompany\Integrations\ZohoCrm\ZohoCrmService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List users from Zoho CRM with optional type filtering and pagination.
 *
 * Supports filtering by user type (e.g. ActiveUsers, Admins, ActiveConfirmedAdmins)
 * and page-based pagination.
 */
class ZohoCrmListUsers implements Tool
{
    /**
     * @param  ZohoCrmService  $service  The Zoho CRM API client
     */
    public function __construct(
        private ZohoCrmService $service,
    ) {}

    public function name(): string
    {
        return 'zoho_crm_list_users';
    }

    public function description(): string
    {
        return <<<'MD'
        List users from Zoho CRM.
        Optionally filter by user type (e.g. ActiveUsers, Admins) and paginate results.
        MD;
    }

    public function parameters(): array
    {
        return [
            'type' => ['type' => 'string', 'description' => 'User type filter (e.g. ActiveUsers, Admins, ActiveConfirmedAdmins).'],
            'page' => ['type' => 'integer', 'description' => 'Page number (default 1).'],
        ];
    }

    /**
     * List Zoho CRM users with optional filtering and pagination.
     *
     * @param  array<string, mixed>  $args  Tool arguments (type, page)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Zoho CRM integration is not configured.');
            }

            $params = [];

            if (! empty($args['type'])) {
                $params['type'] = $args['type'];
            }
            if (isset($args['page'])) {
                $params['page'] = (int) $args['page'];
            }

            $result = $this->service->listUsers($params);
            $users = $result['users'] ?? [];

            return ToolResult::success([
                'results' => $users,
                'total' => count($users),
                'info' => $result['info'] ?? [],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

<?php

namespace OpenCompany\Integrations\ZohoCrm\Tools;

use OpenCompany\Integrations\ZohoCrm\ZohoCrmService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List users in the Zoho CRM organization.
 *
 * Returns a paginated list of users with optional type filtering.
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
        List users in the Zoho CRM organization.
        Optionally filter by user type (ActiveUsers, DeactivatedUsers, ConfirmedUsers, NotConfirmedUsers, DeletedUsers, ActiveConfirmedUsers, AdminUsers, ActiveConfirmedAdminUsers, CurrentUser) and control pagination.
        MD;
    }

    public function parameters(): array
    {
        return [
            'type' => ['type' => 'string', 'description' => 'User type filter. Possible values: ActiveUsers, DeactivatedUsers, ConfirmedUsers, NotConfirmedUsers, DeletedUsers, ActiveConfirmedUsers, AdminUsers, ActiveConfirmedAdminUsers, CurrentUser.'],
            'page' => ['type' => 'integer', 'description' => 'Page number.'],
            'per_page' => ['type' => 'integer', 'description' => 'Number of records per page.'],
        ];
    }

    /**
     * List Zoho CRM users.
     *
     * @param  array<string, mixed>  $args  Tool arguments (type, page, per_page)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Zoho CRM integration is not configured.');
            }

            $type = $args['type'] ?? null;
            $page = $args['page'] ?? null;
            $perPage = $args['per_page'] ?? null;

            $result = $this->service->listUsers(
                is_string($type) && $type !== '' ? $type : null,
                is_numeric($page) ? (int) $page : null,
                is_numeric($perPage) ? (int) $perPage : null,
            );

            $users = $result['users'] ?? [];

            return ToolResult::success([
                'users' => $users,
                'count' => count($users),
                'info' => $result['info'] ?? [],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

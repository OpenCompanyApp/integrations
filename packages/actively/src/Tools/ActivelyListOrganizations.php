<?php

namespace OpenCompany\Integrations\Actively\Tools;

use OpenCompany\Integrations\Actively\ActivelyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List organizations the authenticated user has access to in Actively.
 *
 * Returns a paginated list of organizations. Use the `limit` and `page`
 * parameters to control pagination. The `org_id` values returned here
 * are used in campaign and contact operations.
 */
class ActivelyListOrganizations implements Tool
{
    public function __construct(
        private ActivelyService $service,
    ) {}

    public function name(): string
    {
        return 'actively_list_organizations';
    }

    public function description(): string
    {
        return 'List organizations you have access to in Actively. Returns organization names and UUIDs needed for campaign and contact operations. Paginate with limit and page parameters.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of organizations to return (default: 25).'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Actively integration is not configured.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 25;
            $page = isset($args['page']) ? (int) $args['page'] : 1;

            $result = $this->service->listOrganizations($limit, $page);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

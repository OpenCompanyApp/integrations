<?php

namespace OpenCompany\Integrations\Freshsales\Tools;

use OpenCompany\Integrations\Freshsales\FreshsalesService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List contacts from Freshsales CRM.
 *
 * Returns a paginated list of contacts with optional sorting.
 * Use this tool to browse or search through your CRM contacts.
 */
class FreshsalesListContacts implements Tool
{
    public function __construct(
        private FreshsalesService $service,
    ) {}

    public function name(): string
    {
        return 'freshsales_list_contacts';
    }

    public function description(): string
    {
        return 'List contacts from Freshsales CRM. Returns paginated results with optional sorting by field and direction.';
    }

    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'per_page' => ['type' => 'integer', 'description' => 'Number of contacts per page (default: 20, max: 100).'],
            'sort' => ['type' => 'string', 'description' => 'Sort direction: "asc" or "desc" (default: "desc").'],
            'sort_by' => ['type' => 'string', 'description' => 'Field to sort by, e.g., "created_at", "updated_at", "first_name".'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Freshsales integration is not configured.');
            }

            $page = isset($args['page']) ? (int) $args['page'] : 1;
            $perPage = isset($args['per_page']) ? (int) $args['per_page'] : 20;
            $sort = $args['sort'] ?? null;
            $sortBy = $args['sort_by'] ?? null;

            $result = $this->service->listContacts($page, $perPage, $sort, $sortBy);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

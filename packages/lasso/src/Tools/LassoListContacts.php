<?php

namespace OpenCompany\Integrations\Lasso\Tools;

use OpenCompany\Integrations\Lasso\LassoService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: List Contacts.
 *
 * Lists contacts (registrants) in Lasso CRM with optional filtering
 * and pagination support.
 */
class LassoListContacts implements Tool
{
    /**
     * @param  LassoService  $service  The Lasso API service instance.
     */
    public function __construct(
        private LassoService $service,
    ) {}

    /**
     * Get the tool identifier.
     */
    public function name(): string
    {
        return 'lasso_list_contacts';
    }

    /**
     * Get the human-readable tool description.
     */
    public function description(): string
    {
        return 'List contacts (registrants) in Lasso CRM. Optionally filter by project ID or other criteria. Supports pagination.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'project_id' => ['type' => 'string', 'description' => 'Filter contacts by project ID.'],
            'limit'      => ['type' => 'integer', 'description' => 'Maximum number of contacts to return (default: 25).'],
            'page'       => ['type' => 'integer', 'description' => 'Page number for pagination.'],
        ];
    }

    /**
     * Execute the list contacts tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments (project_id, limit, page).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Lasso CRM integration is not configured.');
            }

            $filters = [];
            if (isset($args['project_id'])) {
                $filters['project_id'] = $args['project_id'];
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 25;
            $page  = isset($args['page']) ? (int) $args['page'] : null;

            $result = $this->service->listContacts($filters, $limit, $page);

            $contacts = $result['data'] ?? [];
            $total    = $result['total'] ?? count($contacts);

            return ToolResult::success([
                'contacts' => $contacts,
                'count'    => count($contacts),
                'total'    => $total,
                'page'     => $result['current_page'] ?? $page ?? 1,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

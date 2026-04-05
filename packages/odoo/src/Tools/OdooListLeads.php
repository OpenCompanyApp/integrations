<?php

namespace OpenCompany\Integrations\Odoo\Tools;

use OpenCompany\Integrations\Odoo\OdooService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: List CRM leads and opportunities from Odoo with pagination and optional filtering.
 *
 * Retrieves a paginated list of leads/opportunities (crm.lead) from the Odoo instance.
 * Supports filtering by stage, type, assigned user, and other fields.
 */
class OdooListLeads implements Tool
{
    /**
     * @param  OdooService  $service  The Odoo service instance for making API calls.
     */
    public function __construct(
        private OdooService $service,
    ) {}

    /**
     * Get the tool name used for registration and dispatch.
     */
    public function name(): string
    {
        return 'odoo_list_leads';
    }

    /**
     * Get the human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'List CRM leads and opportunities from Odoo with pagination. Filter by stage, type, or assigned user.';
    }

    /**
     * Get the parameter schema for this tool.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'limit' => ['type' => 'integer', 'description' => 'Number of leads per page (default: 20, max: 100).'],
            'type' => ['type' => 'string', 'description' => 'Filter by type: "lead" or "opportunity".'],
            'stage' => ['type' => 'string', 'description' => 'Filter by stage name (e.g., "New", "Qualified", "Won", "Lost").'],
            'user_id' => ['type' => 'integer', 'description' => 'Filter by assigned salesperson (user ID).'],
            'partner_id' => ['type' => 'integer', 'description' => 'Filter by customer (partner) ID.'],
        ];
    }

    /**
     * Execute the tool — fetch a paginated list of leads from Odoo.
     *
     * @param  array<string, mixed>  $args  The tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Odoo integration is not configured.');
            }

            $page = isset($args['page']) ? (int) $args['page'] : 1;
            $limit = isset($args['limit']) ? min((int) $args['limit'], 100) : 20;

            $filters = [];
            foreach (['type', 'stage', 'user_id', 'partner_id'] as $field) {
                if (isset($args[$field])) {
                    $filters[$field] = $args[$field];
                }
            }

            $result = $this->service->listLeads($page, $limit, $filters);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

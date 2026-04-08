<?php

namespace OpenCompany\Integrations\Odoo\Tools;

use OpenCompany\Integrations\Odoo\OdooService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: List contacts from Odoo with pagination and optional filtering.
 *
 * Retrieves a paginated list of contacts (res.partner) from the Odoo instance.
 * Supports filtering by name, email, or other fields.
 */
class OdooListContacts implements Tool
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
        return 'odoo_list_contacts';
    }

    /**
     * Get the human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'List contacts (customers, vendors) from Odoo with pagination. Returns contact names, emails, phone numbers, and company info.';
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
            'limit' => ['type' => 'integer', 'description' => 'Number of contacts per page (default: 20, max: 100).'],
            'name' => ['type' => 'string', 'description' => 'Filter contacts by name (partial match).'],
            'email' => ['type' => 'string', 'description' => 'Filter contacts by email (partial match).'],
            'is_company' => ['type' => 'boolean', 'description' => 'Filter to only companies (true) or individuals (false).'],
        ];
    }

    /**
     * Execute the tool — fetch a paginated list of contacts from Odoo.
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
            if (isset($args['name'])) {
                $filters['name'] = $args['name'];
            }
            if (isset($args['email'])) {
                $filters['email'] = $args['email'];
            }
            if (isset($args['is_company'])) {
                $filters['is_company'] = $args['is_company'];
            }

            $result = $this->service->listContacts($page, $limit, $filters);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

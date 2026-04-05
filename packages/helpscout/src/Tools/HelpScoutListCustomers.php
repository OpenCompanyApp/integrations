<?php

namespace OpenCompany\Integrations\HelpScout\Tools;

use OpenCompany\Integrations\HelpScout\HelpScoutService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class HelpScoutListCustomers implements Tool
{
    /**
     * @param  HelpScoutService  $service  The HelpScout API service instance.
     */
    public function __construct(
        private HelpScoutService $service,
    ) {}

    /**
     * The tool identifier.
     */
    public function name(): string
    {
        return 'helpscout_list_customers';
    }

    /**
     * A description of what the tool does, used by AI agents.
     */
    public function description(): string
    {
        return 'List or search customers in HelpScout. Supports filtering by name, email, and pagination.';
    }

    /**
     * Parameter schema for the tool.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'first_name' => ['type' => 'string', 'description' => 'Filter by first name (partial match).'],
            'last_name' => ['type' => 'string', 'description' => 'Filter by last name (partial match).'],
            'email' => ['type' => 'string', 'description' => 'Filter by email address (partial match).'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'per_page' => ['type' => 'integer', 'description' => 'Number of results per page (default: 25, max: 50).'],
            'sort_field' => ['type' => 'string', 'description' => 'Sort field: "firstName", "lastName", "createdAt", "updatedAt".'],
            'sort_order' => ['type' => 'string', 'description' => 'Sort direction: "asc" or "desc" (default: "asc").'],
            'query' => ['type' => 'string', 'description' => 'Search query to filter customers by keyword.'],
        ];
    }

    /**
     * Execute the tool call.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return ToolResult
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('HelpScout integration is not configured.');
            }

            $params = array_filter([
                'firstName' => $args['first_name'] ?? null,
                'lastName' => $args['last_name'] ?? null,
                'email' => $args['email'] ?? null,
                'page' => $args['page'] ?? null,
                'per_page' => $args['per_page'] ?? null,
                'sortField' => $args['sort_field'] ?? null,
                'sortOrder' => $args['sort_order'] ?? null,
                'query' => $args['query'] ?? null,
            ], fn ($value) => $value !== null);

            $result = $this->service->listCustomers($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

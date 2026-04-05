<?php

namespace OpenCompany\Integrations\Freshsales\Tools;

use OpenCompany\Integrations\Freshsales\FreshsalesService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class FreshsalesListAccounts implements Tool
{
    /**
     * Create a new FreshsalesListAccounts tool instance.
     */
    public function __construct(
        private FreshsalesService $service,
    ) {}

    /**
     * Get the tool name.
     */
    public function name(): string
    {
        return 'freshsales_list_accounts';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'List sales accounts from Freshsales CRM. Returns account details including name, industry, and website.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'per_page' => ['type' => 'integer', 'description' => 'Number of accounts per page (default: 20, max: 100).'],
            'sort' => ['type' => 'string', 'description' => 'Field to sort by (e.g., "created_at", "updated_at", "name").'],
            'sort_type' => ['type' => 'string', 'description' => 'Sort direction: "asc" or "desc" (default: "desc").'],
        ];
    }

    /**
     * Execute the tool with the given arguments.
     *
     * @param  array<string, mixed>  $args
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Freshsales integration is not configured.');
            }

            $filters = [];
            if (isset($args['page'])) {
                $filters['page'] = (int) $args['page'];
            }
            if (isset($args['per_page'])) {
                $filters['per_page'] = (int) $args['per_page'];
            }
            if (isset($args['sort'])) {
                $filters['sort'] = $args['sort'];
            }
            if (isset($args['sort_type'])) {
                $filters['sort_type'] = $args['sort_type'];
            }

            $result = $this->service->listAccounts($filters);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

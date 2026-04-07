<?php

namespace OpenCompany\Integrations\Sellfy\Tools;

use OpenCompany\Integrations\Sellfy\SellfyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class SellfyListCustomers implements Tool
{
    public function __construct(
        private SellfyService $service,
    ) {}

    public function name(): string
    {
        return 'sellfy_list_customers';
    }

    public function description(): string
    {
        return 'List all customers in your Sellfy store. Returns customer names, emails, and purchase history.';
    }

    public function parameters(): array
    {
        return [
            'page_size' => ['type' => 'integer', 'description' => 'Number of customers per page (default: 10).'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Sellfy integration is not configured.');
            }

            $pageSize = isset($args['page_size']) ? (int) $args['page_size'] : 10;
            $page = isset($args['page']) ? (int) $args['page'] : 1;

            $result = $this->service->listCustomers($pageSize, $page);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

<?php

namespace OpenCompany\Integrations\ZohoBills\Tools;

use OpenCompany\Integrations\ZohoBills\ZohoBillsService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class ZohoBillsListItems implements Tool
{
    public function __construct(
        private ZohoBillsService $service,
    ) {}

    public function name(): string
    {
        return 'zoho_bills_list_items';
    }

    public function description(): string
    {
        return 'List items (products and services) from Zoho Bills. Returns paginated results with item details like name, rate, and description.';
    }

    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'per_page' => ['type' => 'integer', 'description' => 'Number of items per page (default: 25, max: 200).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Zoho Bills integration is not configured.');
            }

            $result = $this->service->listItems(
                page: (int) ($args['page'] ?? 1),
                perPage: (int) ($args['per_page'] ?? 25),
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

<?php

namespace OpenCompany\Integrations\LemonSqueezy\Tools;

use OpenCompany\Integrations\LemonSqueezy\LemonSqueezyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class LemonSqueezyListCustomers implements Tool
{
    public function __construct(
        private LemonSqueezyService $service,
    ) {}

    public function name(): string
    {
        return 'lemonsqueezy_list_customers';
    }

    public function description(): string
    {
        return 'List all customers in your Lemon Squeezy store. Returns customer names, emails, and metadata.';
    }

    public function parameters(): array
    {
        return [
            'page_size' => ['type' => 'integer', 'description' => 'Number of customers per page (default: 10, max: 100).'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Lemon Squeezy integration is not configured.');
            }

            $pageSize = isset($args['page_size']) ? min((int) $args['page_size'], 100) : 10;
            $page = isset($args['page']) ? (int) $args['page'] : 1;

            $result = $this->service->listCustomers($pageSize, $page);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

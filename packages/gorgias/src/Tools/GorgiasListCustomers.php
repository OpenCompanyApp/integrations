<?php

namespace OpenCompany\Integrations\Gorgias\Tools;

use OpenCompany\Integrations\Gorgias\GorgiasService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class GorgiasListCustomers implements Tool
{
    public function __construct(
        private GorgiasService $service,
    ) {}

    public function name(): string
    {
        return 'gorgias_list_customers';
    }

    public function description(): string
    {
        return 'List and search customers in Gorgias. Filter by search query covering name, email, and other fields. Returns paginated results.';
    }

    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (1-based).'],
            'limit' => ['type' => 'integer', 'description' => 'Number of customers per page (max 100).'],
            'q' => ['type' => 'string', 'description' => 'Search query (name, email, etc.).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Gorgias integration is not configured.');
            }

            $result = $this->service->listCustomers(
                page: isset($args['page']) ? (int) $args['page'] : null,
                limit: isset($args['limit']) ? (int) $args['limit'] : null,
                q: $args['q'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

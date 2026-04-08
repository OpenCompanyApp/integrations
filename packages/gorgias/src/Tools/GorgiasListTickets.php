<?php

namespace OpenCompany\Integrations\Gorgias\Tools;

use OpenCompany\Integrations\Gorgias\GorgiasService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class GorgiasListTickets implements Tool
{
    public function __construct(
        private GorgiasService $service,
    ) {}

    public function name(): string
    {
        return 'gorgias_list_tickets';
    }

    public function description(): string
    {
        return 'List and search support tickets in Gorgias. Filter by status or search by keyword. Returns paginated results with ticket IDs, subjects, and metadata.';
    }

    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (1-based).'],
            'limit' => ['type' => 'integer', 'description' => 'Number of tickets per page (max 100).'],
            'status' => ['type' => 'string', 'description' => 'Filter by ticket status: open, closed, spam.'],
            'q' => ['type' => 'string', 'description' => 'Search query to filter tickets by subject, content, or customer.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Gorgias integration is not configured.');
            }

            $result = $this->service->listTickets(
                page: isset($args['page']) ? (int) $args['page'] : null,
                limit: isset($args['limit']) ? (int) $args['limit'] : null,
                status: $args['status'] ?? null,
                q: $args['q'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

<?php

namespace OpenCompany\Integrations\Accelo\Tools;

use OpenCompany\Integrations\Accelo\AcceloService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: accelo_list_tickets
 *
 * Lists support tickets from Accelo with optional filtering by status
 * and pagination support via limit/page parameters.
 */
class AcceloListTickets implements Tool
{
    public function __construct(
        private AcceloService $service,
    ) {}

    public function name(): string
    {
        return 'accelo_list_tickets';
    }

    public function description(): string
    {
        return 'List support tickets in Accelo. Returns a paginated list of tickets, optionally filtered by status.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Number of tickets to return per page (default: 25, max: 100).'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (1-based).'],
            'status' => ['type' => 'string', 'description' => 'Filter tickets by status (e.g. "open", "closed", "resolved").'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Accelo integration is not configured.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 25;
            $page = isset($args['page']) ? (int) $args['page'] : 1;
            $status = $args['status'] ?? null;

            $result = $this->service->listTickets($limit, $page, $status);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

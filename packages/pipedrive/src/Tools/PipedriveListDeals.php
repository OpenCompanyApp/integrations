<?php

namespace OpenCompany\Integrations\Pipedrive\Tools;

use OpenCompany\Integrations\Pipedrive\PipedriveService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List deals in Pipedrive CRM with optional filters.
 *
 * Supports filtering by status and pagination via start/limit.
 */
class PipedriveListDeals implements Tool
{
    /**
     * @param  PipedriveService  $service  The Pipedrive API client
     */
    public function __construct(
        private PipedriveService $service,
    ) {}

    public function name(): string
    {
        return 'pipedrive_list_deals';
    }

    public function description(): string
    {
        return 'List deals in Pipedrive. Optionally filter by status (open, won, lost, deleted) and paginate results.';
    }

    public function parameters(): array
    {
        return [
            'status' => ['type' => 'string', 'description' => 'Filter by status: "open", "won", "lost", or "deleted".'],
            'start'  => ['type' => 'integer', 'description' => 'Pagination start offset (default 0).'],
            'limit'  => ['type' => 'integer', 'description' => 'Maximum number of results to return (default 100).'],
        ];
    }

    /**
     * List Pipedrive deals with optional filters and pagination.
     *
     * @param  array<string, mixed>  $args  Tool arguments (status, start, limit)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Pipedrive integration is not configured.');
            }

            $params = [];

            if (! empty($args['status'])) {
                $params['status'] = $args['status'];
            }
            if (isset($args['start'])) {
                $params['start'] = (int) $args['start'];
            }
            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }

            $result = $this->service->listDeals($params);
            $deals = $result['data'] ?? $result;

            return ToolResult::success($deals);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

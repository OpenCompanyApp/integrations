<?php

namespace OpenCompany\Integrations\Fathom\Tools;

use OpenCompany\Integrations\Fathom\FathomService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to list pageviews for a Fathom site.
 *
 * Returns a paginated list of individual pageview records with optional date filtering.
 */
class FathomListPageviews implements Tool
{
    /**
     * Create a new FathomListPageviews tool instance.
     *
     * @param  FathomService  $service  The Fathom API service instance.
     */
    public function __construct(
        private FathomService $service,
    ) {}

    /**
     * Get the tool name used for registration and dispatch.
     */
    public function name(): string
    {
        return 'fathom_list_pageviews';
    }

    /**
     * Get the tool description shown to AI agents.
     */
    public function description(): string
    {
        return 'List pageviews for a Fathom Analytics site with date filtering and pagination. Returns individual pageview records including URL, referrer, and device info.';
    }

    /**
     * Get the tool parameter schema.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'site_id' => ['type' => 'string', 'required' => true, 'description' => 'The Fathom site ID (e.g., "CDCLS").'],
            'date_from' => ['type' => 'string', 'description' => 'Start date for filtering (ISO 8601, e.g., "2025-01-01").'],
            'date_to' => ['type' => 'string', 'description' => 'End date for filtering (ISO 8601, e.g., "2025-01-31").'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of pageviews to return (default: 20).'],
            'starting_after' => ['type' => 'integer', 'description' => 'Cursor for pagination — pass the ID of the last pageview from a previous response.'],
        ];
    }

    /**
     * Execute the tool and return a list of pageviews.
     *
     * @param  array<string, mixed>  $args  Tool arguments (site_id, date_from, date_to, limit, starting_after).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Fathom integration is not configured.');
            }

            $siteId = $args['site_id'] ?? '';
            if (empty($siteId)) {
                return ToolResult::error('site_id is required.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 20;
            $startingAfter = isset($args['starting_after']) ? (int) $args['starting_after'] : null;

            $result = $this->service->listPageviews(
                siteId: $siteId,
                dateFrom: $args['date_from'] ?? null,
                dateTo: $args['date_to'] ?? null,
                limit: $limit,
                startingAfter: $startingAfter,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

<?php

namespace OpenCompany\Integrations\Insightly\Tools;

use OpenCompany\Integrations\Insightly\InsightlyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: List Opportunities
 *
 * Lists opportunities from Insightly CRM with optional pagination and status filtering.
 *
 * @see https://api.na1.insightly.com/v3.1/Help#!/Opportunities/GetEntities
 */
class InsightlyListOpportunities implements Tool
{
    /**
     * Create a new InsightlyListOpportunities tool instance.
     *
     * @param  InsightlyService  $service  The Insightly API service.
     */
    public function __construct(
        private InsightlyService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'insightly_list_opportunities';
    }

    /**
     * Get the tool description for AI agents.
     */
    public function description(): string
    {
        return 'List opportunities from Insightly CRM. Returns opportunity records with names, amounts, stages, and pipeline info. Use top/skip for pagination and status to filter by opportunity state.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>> Parameter definitions keyed by name.
     */
    public function parameters(): array
    {
        return [
            'top' => ['type' => 'integer', 'description' => 'Maximum number of opportunities to return.'],
            'skip' => ['type' => 'integer', 'description' => 'Number of opportunities to skip for pagination.'],
            'status' => ['type' => 'string', 'description' => 'Filter by opportunity status (e.g., "Open", "Won", "Lost", "Suspended").'],
        ];
    }

    /**
     * Execute the list opportunities tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments (top, skip, status).
     * @return ToolResult The list of opportunities or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Insightly integration is not configured.');
            }

            $result = $this->service->listOpportunities(
                top: isset($args['top']) ? (int) $args['top'] : null,
                skip: isset($args['skip']) ? (int) $args['skip'] : null,
                status: $args['status'] ?? null,
            );

            return ToolResult::success([
                'opportunities' => $result,
                'count' => count($result),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

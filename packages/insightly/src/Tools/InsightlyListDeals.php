<?php

namespace OpenCompany\Integrations\Insightly\Tools;

use OpenCompany\Integrations\Insightly\InsightlyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: List Deals
 *
 * Lists deals (opportunities) from Insightly CRM with optional pagination, ordering, and filtering.
 *
 * @see https://api.na1.insightly.com/v3.1/Help#!/Opportunities/GetEntities
 */
class InsightlyListDeals implements Tool
{
    /**
     * Create a new InsightlyListDeals tool instance.
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
        return 'insightly_list_deals';
    }

    /**
     * Get the tool description for AI agents.
     */
    public function description(): string
    {
        return 'List deals (opportunities) from Insightly CRM. Returns deal records with names, amounts, stages, and pipeline info. Use pagination parameters to browse large result sets.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>> Parameter definitions keyed by name.
     */
    public function parameters(): array
    {
        return [
            'top' => ['type' => 'integer', 'description' => 'Maximum number of deals to return.'],
            'skip' => ['type' => 'integer', 'description' => 'Number of deals to skip for pagination.'],
            'order_by' => ['type' => 'string', 'description' => 'Field to order by (e.g., "DATE_CREATED_UTC desc").'],
            'filter' => ['type' => 'string', 'description' => 'Insightly filter expression (e.g., "OPPORTUNITY_STATE eq \'Open\'").'],
            'brief' => ['type' => 'boolean', 'description' => 'Set to true for a reduced payload with only key fields.'],
        ];
    }

    /**
     * Execute the list deals tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments (top, skip, order_by, filter, brief).
     * @return ToolResult The list of deals or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Insightly integration is not configured.');
            }

            $result = $this->service->listDeals(
                top: isset($args['top']) ? (int) $args['top'] : null,
                skip: isset($args['skip']) ? (int) $args['skip'] : null,
                brief: isset($args['brief']) ? ($args['brief'] ? 'true' : null) : null,
                orderBy: $args['order_by'] ?? null,
                filter: $args['filter'] ?? null,
            );

            return ToolResult::success([
                'deals' => $result,
                'count' => count($result),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

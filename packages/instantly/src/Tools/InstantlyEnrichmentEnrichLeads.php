<?php

namespace OpenCompany\Integrations\Instantly\Tools;

use OpenCompany\Integrations\Instantly\InstantlyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Enrich leads from SuperSearch. Import and enrich leads matching your search filters.
 */
class InstantlyEnrichmentEnrichLeads implements Tool
{
    /**
     * @param  InstantlyService  $service  The Instantly API client
     */
    public function __construct(
        private InstantlyService $service,
    ) {}

    public function name(): string
    {
        return 'instantly_enrichment_enrich_leads';
    }

    public function description(): string
    {
        return 'Enrich leads from SuperSearch. Import and enrich leads matching your search filters.';
    }

    public function parameters(): array
    {
        return [
            'search_filters' => ['type' => 'string', 'required' => true, 'description' => 'JSON search filters'],
            'limit' => ['type' => 'integer', 'required' => true, 'description' => 'Max leads to import'],
        ];
    }

    /**
     * @param  array<string, mixed>  $args
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Instantly integration is not configured.');
            }

            $result = $filters = $args['search_filters']; if (is_string($filters)) $filters = json_decode($filters, true); $this->service->enrichLeads(['search_filters' => $filters, 'limit' => $args['limit']]);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

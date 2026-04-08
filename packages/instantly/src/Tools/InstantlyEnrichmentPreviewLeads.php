<?php

namespace OpenCompany\Integrations\Instantly\Tools;

use OpenCompany\Integrations\Instantly\InstantlyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Preview leads matching SuperSearch filters without importing.
 */
class InstantlyEnrichmentPreviewLeads implements Tool
{
    /**
     * @param  InstantlyService  $service  The Instantly API client
     */
    public function __construct(
        private InstantlyService $service,
    ) {}

    public function name(): string
    {
        return 'instantly_enrichment_preview_leads';
    }

    public function description(): string
    {
        return 'Preview leads matching SuperSearch filters without importing.';
    }

    public function parameters(): array
    {
        return [
            'search_filters' => ['type' => 'string', 'required' => true, 'description' => 'JSON search filters'],
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

            $result = $filters = $args['search_filters']; if (is_string($filters)) $filters = json_decode($filters, true); $this->service->previewLeads(['search_filters' => $filters]);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

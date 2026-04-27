<?php

namespace OpenCompany\Integrations\Instantly\Tools;

use OpenCompany\Integrations\Instantly\InstantlyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update enrichment settings for a resource.
 */
class InstantlyUpdateEnrichmentSettings implements Tool
{
    /**
     * @param  InstantlyService  $service  The Instantly API client
     */
    public function __construct(
        private InstantlyService $service,
    ) {}

    public function name(): string
    {
        return 'instantly_update_enrichment_settings';
    }

    public function description(): string
    {
        return 'Update enrichment settings for a resource.';
    }

    public function parameters(): array
    {
        return [
            'resource_id' => ['type' => 'string', 'required' => true, 'description' => 'Resource ID'],
            'auto_update' => ['type' => 'boolean', 'required' => false, 'description' => 'Auto-enrich new leads'],
            'skip_rows_without_email' => ['type' => 'boolean', 'required' => false, 'description' => 'Skip leads without email'],
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

            $body = []; foreach (['auto_update','skip_rows_without_email'] as $k) if (isset($args[$k])) $body[$k] = $args[$k]; $result = $this->service->updateEnrichmentSettings($args['resource_id'], $body);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

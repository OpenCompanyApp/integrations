<?php

namespace OpenCompany\Integrations\Instantly\Tools;

use OpenCompany\Integrations\Instantly\InstantlyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Run enrichment for a campaign or lead list.
 */
class InstantlyRunEnrichment implements Tool
{
    /**
     * @param  InstantlyService  $service  The Instantly API client
     */
    public function __construct(
        private InstantlyService $service,
    ) {}

    public function name(): string
    {
        return 'instantly_run_enrichment';
    }

    public function description(): string
    {
        return 'Run enrichment for a campaign or lead list.';
    }

    public function parameters(): array
    {
        return [
            'resource_id' => ['type' => 'string', 'required' => true, 'description' => 'Resource ID'],
            'lead_ids' => ['type' => 'string', 'required' => false, 'description' => 'Comma-separated lead IDs'],
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

            $result = $body = ['resource_id' => $args['resource_id']]; if (isset($args['lead_ids'])) { $ids = $args['lead_ids']; $body['lead_ids'] = is_string($ids) ? array_map('trim', explode(',', $ids)) : $ids; } $this->service->runEnrichment($body);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

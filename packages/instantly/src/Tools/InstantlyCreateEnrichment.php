<?php

namespace OpenCompany\Integrations\Instantly\Tools;

use OpenCompany\Integrations\Instantly\InstantlyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create an enrichment for a resource (campaign or lead list).
 */
class InstantlyCreateEnrichment implements Tool
{
    /**
     * @param  InstantlyService  $service  The Instantly API client
     */
    public function __construct(
        private InstantlyService $service,
    ) {}

    public function name(): string
    {
        return 'instantly_create_enrichment';
    }

    public function description(): string
    {
        return 'Create an enrichment for a resource (campaign or lead list).';
    }

    public function parameters(): array
    {
        return [
            'resource_id' => ['type' => 'string', 'required' => true, 'description' => 'Resource ID'],
            'type' => ['type' => 'string', 'required' => true, 'description' => 'Enrichment type'],
            'limit' => ['type' => 'integer', 'required' => false, 'description' => 'Max leads to enrich'],
            'filters' => ['type' => 'string', 'required' => false, 'description' => 'JSON filters'],
            'custom_flow' => ['type' => 'string', 'required' => false, 'description' => 'JSON custom flow'],
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

            $body = ['resource_id' => $args['resource_id'], 'type' => $args['type']]; foreach (['limit','filters','custom_flow'] as $k) if (isset($args[$k])) { $v = $args[$k]; $body[$k] = (in_array($k, ['filters','custom_flow']) && is_string($v)) ? json_decode($v, true) : $v; } $result = $this->service->createEnrichment($body);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

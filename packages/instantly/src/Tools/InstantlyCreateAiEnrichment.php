<?php

namespace OpenCompany\Integrations\Instantly\Tools;

use OpenCompany\Integrations\Instantly\InstantlyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create AI enrichment for a resource. Uses AI models to generate custom columns.
 */
class InstantlyCreateAiEnrichment implements Tool
{
    /**
     * @param  InstantlyService  $service  The Instantly API client
     */
    public function __construct(
        private InstantlyService $service,
    ) {}

    public function name(): string
    {
        return 'instantly_create_ai_enrichment';
    }

    public function description(): string
    {
        return 'Create AI enrichment for a resource. Uses AI models to generate custom columns.';
    }

    public function parameters(): array
    {
        return [
            'resource_id' => ['type' => 'string', 'required' => true, 'description' => 'Resource ID'],
            'output_column' => ['type' => 'string', 'required' => true, 'description' => 'Output column name'],
            'resource_type' => ['type' => 'integer', 'required' => true, 'description' => 'Resource type'],
            'model_version' => ['type' => 'string', 'required' => true, 'description' => 'AI model version'],
            'input_columns' => ['type' => 'string', 'required' => false, 'description' => 'Comma-separated input columns'],
            'use_instantly_account' => ['type' => 'boolean', 'required' => false, 'description' => 'Use Instantly account'],
            'overwrite' => ['type' => 'boolean', 'required' => false, 'description' => 'Overwrite existing values'],
            'auto_update' => ['type' => 'boolean', 'required' => false, 'description' => 'Auto-enrich new leads'],
            'skip_leads_without_email' => ['type' => 'boolean', 'required' => false, 'description' => 'Skip leads without email'],
            'limit' => ['type' => 'integer', 'required' => false, 'description' => 'Max leads to enrich'],
            'prompt' => ['type' => 'string', 'required' => false, 'description' => 'Custom AI prompt'],
            'template_id' => ['type' => 'integer', 'required' => false, 'description' => 'Prompt template ID'],
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

            $body = ['resource_id' => $args['resource_id'], 'output_column' => $args['output_column'], 'resource_type' => $args['resource_type'], 'model_version' => $args['model_version']]; foreach (['input_columns','use_instantly_account','overwrite','auto_update','skip_leads_without_email','limit','prompt','template_id'] as $k) if (isset($args[$k])) $body[$k] = $args[$k]; $result = $this->service->createAiEnrichment($body);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

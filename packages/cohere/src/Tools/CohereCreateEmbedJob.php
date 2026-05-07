<?php

namespace OpenCompany\Integrations\Cohere\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Start an asynchronous Cohere embed job.
 *
 * Uses a validated embed-input dataset and returns the created job ID.
 */
class CohereCreateEmbedJob extends AbstractCohereTool implements Tool
{
    public function name(): string
    {
        return 'cohere_create_embed_job';
    }

    public function description(): string
    {
        return 'Start a Cohere embed job for a validated embed-input dataset. Use list/get embed job to track completion and read output_dataset_id.';
    }

    public function parameters(): array
    {
        return [
            'model' => ['type' => 'string', 'required' => true, 'description' => 'Embedding model ID.'],
            'dataset_id' => ['type' => 'string', 'required' => true, 'description' => 'Validated embed-input dataset ID.'],
            'input_type' => ['type' => 'string', 'required' => true, 'enum' => ['search_document', 'search_query', 'classification', 'clustering', 'image'], 'description' => 'Embedding input type.'],
            'truncate' => ['type' => 'string', 'enum' => ['NONE', 'START', 'END'], 'description' => 'How to truncate text that exceeds model limits.'],
            'name' => ['type' => 'string', 'description' => 'Optional embed job display name.'],
        ];
    }

    /**
     * Execute the Cohere Create Embed Job API call.
     *
     * @param  array<string, mixed>  $args  Tool arguments matching the Embed Jobs create endpoint.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Cohere integration is not configured.');
            }

            $this->assertEnum('input_type', $args['input_type'] ?? null, ['search_document', 'search_query', 'classification', 'clustering', 'image']);
            $this->assertEnum('truncate', $args['truncate'] ?? null, ['NONE', 'START', 'END']);

            $payload = $this->only($args, ['model', 'dataset_id', 'input_type', 'truncate', 'name']);
            $payload['model'] = $this->requireString($args, 'model');
            $payload['dataset_id'] = $this->requireString($args, 'dataset_id');
            $payload['input_type'] = $this->requireString($args, 'input_type');

            return ToolResult::success($this->service->createEmbedJob($payload));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

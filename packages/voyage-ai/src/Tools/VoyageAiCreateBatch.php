<?php

namespace OpenCompany\Integrations\VoyageAi\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create and execute a Voyage AI batch job.
 *
 * Supports the official endpoint, input file, completion window,
 * request_params, and metadata fields.
 */
class VoyageAiCreateBatch extends AbstractVoyageAiTool implements Tool
{
    public function name(): string
    {
        return 'voyage_ai_create_batch';
    }

    public function description(): string
    {
        return 'Create a Voyage AI batch inference job for embeddings, contextualized embeddings, or rerank requests using an uploaded JSONL file.';
    }

    public function parameters(): array
    {
        return [
            'endpoint' => ['type' => 'string', 'required' => true, 'description' => 'Batch endpoint: v1/embeddings, v1/contextualizedembeddings, or v1/rerank.'],
            'input_file_id' => ['type' => 'string', 'required' => true, 'description' => 'Uploaded JSONL file ID with purpose=batch.'],
            'completion_window' => ['type' => 'string', 'required' => true, 'description' => 'Completion window. Currently only 12h is supported.'],
            'request_params' => ['type' => 'object', 'required' => true, 'description' => 'Endpoint parameters shared by every request in the batch, excluding per-line input data.'],
            'metadata' => ['type' => 'object', 'description' => 'Optional metadata object. Upstream supports up to 16 key-value pairs.'],
        ];
    }

    /**
     * Execute the create batch API call.
     *
     * @param  array<string, mixed>  $args  Tool arguments matching the create batch request.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Voyage AI integration is not configured.');
            }

            $endpoint = $this->requireString($args, 'endpoint');
            if (!in_array($endpoint, ['v1/embeddings', 'v1/contextualizedembeddings', 'v1/rerank'], true)) {
                return ToolResult::error('endpoint must be one of: v1/embeddings, v1/contextualizedembeddings, v1/rerank.');
            }

            $completionWindow = $this->requireString($args, 'completion_window');
            if ($completionWindow !== '12h') {
                return ToolResult::error('completion_window must be "12h".');
            }

            $payload = $this->only($args, ['endpoint', 'input_file_id', 'completion_window', 'request_params', 'metadata']);
            $payload['endpoint'] = $endpoint;
            $payload['input_file_id'] = $this->requireString($args, 'input_file_id');
            $payload['completion_window'] = $completionWindow;
            $payload['request_params'] = $this->requireArray($args, 'request_params');

            return ToolResult::success($this->service->createBatch($payload));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

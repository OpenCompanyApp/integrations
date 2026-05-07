<?php

namespace OpenCompany\Integrations\VoyageAi\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create text embeddings using Voyage AI.
 *
 * Supports model, input type, truncation, output dimension, output dtype,
 * and base64 encoding controls from the official embeddings endpoint.
 */
class VoyageAiCreateEmbedding extends AbstractVoyageAiTool implements Tool
{
    public function name(): string
    {
        return 'voyage_ai_create_embedding';
    }

    public function description(): string
    {
        return 'Create text embeddings with Voyage AI. Use input_type=query for search queries and input_type=document for indexed documents.';
    }

    public function parameters(): array
    {
        return [
            'input' => ['type' => ['string', 'array'], 'required' => true, 'description' => 'Single text string or array of text strings.'],
            'model' => ['type' => 'string', 'required' => true, 'description' => 'Embedding model name, e.g. voyage-4, voyage-4-large, voyage-4-lite, voyage-code-3.'],
            'input_type' => ['type' => 'string', 'enum' => ['query', 'document'], 'description' => 'Input intent. Use query or document for retrieval workflows.'],
            'truncation' => ['type' => 'boolean', 'description' => 'Whether to truncate inputs to fit model context. Defaults to true upstream.'],
            'output_dimension' => ['type' => 'integer', 'description' => 'Optional output dimensions: commonly 2048, 1024, 512, or 256 for supported models.'],
            'output_dtype' => ['type' => 'string', 'enum' => ['float', 'int8', 'uint8', 'binary', 'ubinary'], 'description' => 'Embedding data type.'],
            'encoding_format' => ['type' => 'string', 'enum' => ['base64'], 'description' => 'Optional base64 encoding for embeddings.'],
        ];
    }

    /**
     * Execute the text embeddings API call.
     *
     * @param  array<string, mixed>  $args  Tool arguments matching the Voyage embeddings request.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Voyage AI integration is not configured.');
            }

            $this->assertEnum('input_type', $args['input_type'] ?? null, ['query', 'document']);
            $this->assertEnum('output_dtype', $args['output_dtype'] ?? null, ['float', 'int8', 'uint8', 'binary', 'ubinary']);
            $this->assertEnum('encoding_format', $args['encoding_format'] ?? null, ['base64']);

            $payload = $this->only($args, ['input', 'model', 'input_type', 'truncation', 'output_dimension', 'output_dtype', 'encoding_format']);
            $payload['input'] = $this->requireStringOrList($args, 'input');
            $payload['model'] = $this->requireString($args, 'model');

            return ToolResult::success($this->service->createEmbedding($payload));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

<?php

namespace OpenCompany\Integrations\VoyageAi\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create contextualized embeddings for grouped chunks.
 *
 * Encodes each inner input list with awareness of neighboring chunks in the
 * same document or group, matching Voyage's contextualized embeddings API.
 */
class VoyageAiCreateContextualizedEmbeddings extends AbstractVoyageAiTool implements Tool
{
    public function name(): string
    {
        return 'voyage_ai_create_contextualized_embeddings';
    }

    public function description(): string
    {
        return 'Create contextualized chunk embeddings. Pass inputs as an array of arrays where each inner array contains chunks from one document or one query/document item.';
    }

    public function parameters(): array
    {
        return [
            'inputs' => ['type' => 'array', 'required' => true, 'description' => 'Array of arrays of strings to embed together with context.'],
            'model' => ['type' => 'string', 'required' => true, 'description' => 'Model name. Recommended: voyage-context-3.'],
            'input_type' => ['type' => 'string', 'enum' => ['query', 'document'], 'description' => 'Input intent. Use query or document for retrieval workflows.'],
            'output_dimension' => ['type' => 'integer', 'description' => 'Output dimensions. voyage-context-3 supports 2048, 1024, 512, 256.'],
            'output_dtype' => ['type' => 'string', 'enum' => ['float', 'int8', 'uint8', 'binary', 'ubinary'], 'description' => 'Embedding data type.'],
            'encoding_format' => ['type' => 'string', 'enum' => ['base64'], 'description' => 'Optional base64 encoding for embeddings.'],
        ];
    }

    /**
     * Execute the contextualized embeddings API call.
     *
     * @param  array<string, mixed>  $args  Tool arguments matching the Voyage contextualized embeddings request.
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

            $payload = $this->only($args, ['inputs', 'model', 'input_type', 'output_dimension', 'output_dtype', 'encoding_format']);
            $payload['inputs'] = $this->requireArray($args, 'inputs');
            $payload['model'] = $this->requireString($args, 'model');

            return ToolResult::success($this->service->createContextualizedEmbeddings($payload));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

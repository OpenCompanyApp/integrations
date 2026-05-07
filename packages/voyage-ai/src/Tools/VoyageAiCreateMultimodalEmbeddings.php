<?php

namespace OpenCompany\Integrations\VoyageAi\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create multimodal embeddings for text, image, and video inputs.
 *
 * Accepts Voyage's native content block shape so agents can pass interleaved
 * text, image_url, image_base64, video_url, or video_base64 payloads.
 */
class VoyageAiCreateMultimodalEmbeddings extends AbstractVoyageAiTool implements Tool
{
    public function name(): string
    {
        return 'voyage_ai_create_multimodal_embeddings';
    }

    public function description(): string
    {
        return 'Create Voyage AI multimodal embeddings from inputs containing interleaved text, image, or video content blocks.';
    }

    public function parameters(): array
    {
        return [
            'inputs' => ['type' => 'array', 'required' => true, 'description' => 'Array of objects with a content array of text/image/video blocks.'],
            'model' => ['type' => 'string', 'required' => true, 'description' => 'Model name. Recommended: voyage-multimodal-3.5.'],
            'input_type' => ['type' => 'string', 'enum' => ['query', 'document'], 'description' => 'Input intent. Use query or document for retrieval workflows.'],
            'truncation' => ['type' => 'boolean', 'description' => 'Whether to truncate inputs to fit model context.'],
            'output_encoding' => ['type' => 'string', 'enum' => ['base64'], 'description' => 'Optional base64 encoding for embeddings.'],
        ];
    }

    /**
     * Execute the multimodal embeddings API call.
     *
     * @param  array<string, mixed>  $args  Tool arguments matching the Voyage multimodal embeddings request.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Voyage AI integration is not configured.');
            }

            $this->assertEnum('input_type', $args['input_type'] ?? null, ['query', 'document']);
            $this->assertEnum('output_encoding', $args['output_encoding'] ?? null, ['base64']);

            $payload = $this->only($args, ['inputs', 'model', 'input_type', 'truncation', 'output_encoding']);
            $payload['inputs'] = $this->requireArray($args, 'inputs');
            $payload['model'] = $this->requireString($args, 'model');

            return ToolResult::success($this->service->createMultimodalEmbeddings($payload));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

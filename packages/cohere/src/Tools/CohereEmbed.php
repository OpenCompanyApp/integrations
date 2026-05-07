<?php

namespace OpenCompany\Integrations\Cohere\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create embeddings with Cohere v2 Embed.
 *
 * Supports text, image data URI, and mixed inputs plus documented output
 * dimension, embedding type, truncation, and priority controls.
 */
class CohereEmbed extends AbstractCohereTool implements Tool
{
    public function name(): string
    {
        return 'cohere_embed';
    }

    public function description(): string
    {
        return 'Create Cohere v2 embeddings for texts, image data URIs, or mixed inputs. Use input_type to match the downstream task such as search_document, search_query, classification, clustering, or image.';
    }

    public function parameters(): array
    {
        return [
            'model' => ['type' => 'string', 'required' => true, 'description' => 'Embedding model ID.'],
            'input_type' => ['type' => 'string', 'required' => true, 'enum' => ['search_document', 'search_query', 'classification', 'clustering', 'image'], 'description' => 'Embedding input type.'],
            'texts' => ['type' => 'array', 'items' => ['type' => 'string'], 'description' => 'Text inputs to embed. Maximum 96 per call.'],
            'images' => ['type' => 'array', 'items' => ['type' => 'string'], 'description' => 'Image data URI inputs. Maximum 1 image per call.'],
            'inputs' => ['type' => 'array', 'items' => ['type' => 'object'], 'description' => 'Mixed text/image component inputs. Maximum 96 per call.'],
            'max_tokens' => ['type' => 'integer', 'description' => 'Maximum tokens to embed per input.'],
            'output_dimension' => ['type' => 'integer', 'enum' => [256, 512, 1024, 1536], 'description' => 'Output embedding dimension for embed-v4 and newer models.'],
            'embedding_types' => ['type' => 'array', 'items' => ['type' => 'string'], 'description' => 'Embedding formats such as float, int8, uint8, binary, or ubinary.'],
            'truncate' => ['type' => 'string', 'enum' => ['NONE', 'START', 'END'], 'description' => 'How to truncate inputs that exceed context.'],
            'priority' => ['type' => 'integer', 'description' => 'Priority from 0 to 999, where lower values are handled earlier.'],
        ];
    }

    /**
     * Execute the Cohere Embed API call.
     *
     * @param  array<string, mixed>  $args  Tool arguments matching Cohere v2 Embed parameters.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Cohere integration is not configured.');
            }

            $this->assertEnum('input_type', $args['input_type'] ?? null, ['search_document', 'search_query', 'classification', 'clustering', 'image']);
            $this->assertEnum('truncate', $args['truncate'] ?? null, ['NONE', 'START', 'END']);

            $hasInput = isset($args['texts']) || isset($args['images']) || isset($args['inputs']);
            if (!$hasInput) {
                return ToolResult::error('Provide at least one of texts, images, or inputs.');
            }

            $payload = $this->only($args, [
                'model',
                'input_type',
                'texts',
                'images',
                'inputs',
                'max_tokens',
                'output_dimension',
                'embedding_types',
                'truncate',
                'priority',
            ]);
            $payload['model'] = $this->requireString($args, 'model');
            $payload['input_type'] = $this->requireString($args, 'input_type');

            return ToolResult::success($this->service->embed($payload));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}

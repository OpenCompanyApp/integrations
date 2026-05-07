<?php

namespace OpenCompany\Integrations\Cohere\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Classify texts with Cohere's deprecated v1 Classify endpoint.
 *
 * Kept for compatibility with fine-tuned classification workflows while
 * clearly warning agents that the upstream endpoint is deprecated.
 */
class CohereClassify extends AbstractCohereTool implements Tool
{
    public function name(): string
    {
        return 'cohere_classify';
    }

    public function description(): string
    {
        return 'Classify text with Cohere v1 Classify. Upstream marks this endpoint deprecated; prefer newer chat or embedding workflows unless you need legacy classify compatibility.';
    }

    public function parameters(): array
    {
        return [
            'inputs' => ['type' => 'array', 'required' => true, 'items' => ['type' => 'string'], 'description' => 'Texts to classify. Maximum 96.'],
            'examples' => ['type' => 'array', 'items' => ['type' => 'object'], 'description' => 'Optional examples as objects with text and label. Not required for fine-tuned classify models.'],
            'model' => ['type' => 'string', 'description' => 'Optional fine-tuned Classify model ID.'],
            'truncate' => ['type' => 'string', 'enum' => ['NONE', 'START', 'END'], 'description' => 'How to handle inputs longer than model limits.'],
            'preset' => ['type' => 'string', 'description' => 'Deprecated upstream preset parameter.'],
        ];
    }

    /**
     * Execute the Cohere Classify API call.
     *
     * @param  array<string, mixed>  $args  Tool arguments matching the v1 Classify endpoint.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Cohere integration is not configured.');
            }

            $this->assertEnum('truncate', $args['truncate'] ?? null, ['NONE', 'START', 'END']);

            $payload = $this->only($args, ['inputs', 'examples', 'model', 'truncate', 'preset']);
            $payload['inputs'] = $this->requireStringList($args, 'inputs');

            return ToolResult::success($this->service->classify($payload));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
